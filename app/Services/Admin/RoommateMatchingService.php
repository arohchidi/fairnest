<?php

namespace App\Services\Admin;

use App\Models\Booking;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoommateMatchingService
{
    /**
     * Calculate match score between two bookings
     */
    public function calculateMatchScore(Booking $booking1, Booking $booking2): array
    {
        $score = 0;
        $details = [];

        // Age compatibility (max 20 points)
        $ageDiff = abs(($booking1->roommate_age ?? 0) - ($booking2->roommate_age ?? 0));
        if ($ageDiff <= 2) {
            $score += 20;
            $details['age'] = 'Great match!';
        } elseif ($ageDiff <= 5) {
            $score += 15;
            $details['age'] = 'Good match';
        } elseif ($ageDiff <= 10) {
            $score += 10;
            $details['age'] = 'Acceptable';
        } else {
            $score += 5;
            $details['age'] = 'Significant age difference';
        }

        // Gender compatibility (max 20 points)
        if ($booking1->roommate_gender && $booking2->roommate_gender) {
            if ($booking1->roommate_gender === $booking2->roommate_gender) {
                $score += 20;
                $details['gender'] = 'Same gender!';
            } elseif ($booking1->roommate_gender === 'prefer-not-to-say' || $booking2->roommate_gender === 'prefer-not-to-say') {
                $score += 10;
                $details['gender'] = 'Flexible';
            } else {
                $score += 5;
                $details['gender'] = 'Different genders';
            }
        }

        // State of origin compatibility (max 15 points)
        if ($booking1->roommate_state_of_origin && $booking2->roommate_state_of_origin) {
            if ($booking1->roommate_state_of_origin === $booking2->roommate_state_of_origin) {
                $score += 15;
                $details['state'] = 'Same state!';
            } else {
                $score += 5;
                $details['state'] = 'Different states';
            }
        }

        // Religion compatibility (max 15 points)
        if ($booking1->religion && $booking2->religion) {
            if ($booking1->religion === $booking2->religion) {
                $score += 15;
                $details['religion'] = 'Same religion!';
            } else {
                $score += 5;
                $details['religion'] = 'Different religions';
            }
        }

        // Property proximity (max 30 points)
        if ($booking1->property_id && $booking2->property_id) {
            if ($booking1->property_id === $booking2->property_id) {
                $score += 30;
                $details['property'] = 'Same property!';
            } else {
                // Check if properties are in same city
                $property1 = $booking1->property;
                $property2 = $booking2->property;
                if ($property1 && $property2 && $property1->city === $property2->city) {
                    $score += 15;
                    $details['property'] = 'Same city!';
                } else {
                    $score += 0;
                    $details['property'] = 'Different locations';
                }
            }
        }

        return [
            'score' => min(100, $score),
            'age_difference' => $ageDiff,
            'same_gender' => ($booking1->roommate_gender ?? '') === ($booking2->roommate_gender ?? ''),
            'details' => $details,
            'status' => 'pending',
        ];
    }

    /**
     * Get all potential roommate matches from bookings
     */
    public function getPotentialMatches(): Collection
    {
        // Get all bookings that need a roommate
        $bookings = Booking::where('needs_roommate', true)
            ->where('status', 'confirmed')
            ->with(['property'])
            ->get();

        $matches = collect();

        foreach ($bookings as $i => $booking1) {
            foreach ($bookings as $j => $booking2) {
                // Skip comparing with itself
                if ($i <= $j) {
                    continue;
                }

                // Skip if already matched
                if ($this->isAlreadyMatched($booking1->id, $booking2->id)) {
                    continue;
                }

                $matchData = $this->calculateMatchScore($booking1, $booking2);

                // Only include matches with score > 40
                if ($matchData['score'] >= 40) {
                    $matches->push([
                        'booking1_id' => $booking1->id,
                        'booking2_id' => $booking2->id,
                        'person1' => [
                            'booking_id' => $booking1->id,
                            'name' => $booking1->username,
                            'email' => $booking1->email,
                            'phone' => $booking1->phone,
                            'age' => $booking1->roommate_age,
                            'gender' => $booking1->roommate_gender,
                            'state' => $booking1->state_of_origin,
                            'religion' => $booking1->religion,
                            'notes' => $booking1->roommate_notes,
                            'needs_roommate' => $booking1->needs_roommate,
                            'booking_date' => $booking1->created_at->format('M d, Y'),
                        ],
                        'person2' => [
                            'booking_id' => $booking2->id,
                            'name' => $booking2->username,
                            'email' => $booking2->email,
                            'phone' => $booking2->phone,
                            'age' => $booking2->roommate_age,
                            'gender' => $booking2->roommate_gender,
                            'state' => $booking2->state_of_origin,
                            'religion' => $booking2->religion,
                            'notes' => $booking2->roommate_notes,
                            'needs_roommate' => $booking2->needs_roommate,
                            'booking_date' => $booking2->created_at->format('M d, Y'),
                        ],
                        'match_score' => $matchData['score'],
                        'age_difference' => $matchData['age_difference'],
                        'same_gender' => $matchData['same_gender'],
                        'status' => 'pending',
                    ]);
                }
            }
        }

        return $matches->sortByDesc('match_score');
    }

    /**
     * Check if two bookings are already matched
     */
    protected function isAlreadyMatched($booking1Id, $booking2Id): bool
    {
        // You can implement this with a RoommateMatch model or check existing connections
        return false;
    }

    /**
     * Get matching statistics
     */
    public function getStatistics(): array
    {
        $totalRequests = Booking::where('needs_roommate', true)
            ->where('status', 'confirmed')
            ->count();

        $matches = $this->getPotentialMatches();
        $pendingCount = $matches->count();

        // Calculate match rate based on potential matches
        $matchRate = $totalRequests > 0 ? round(($pendingCount / $totalRequests) * 100) : 0;

        return [
            'total_requests' => $totalRequests,
            'potential_matches' => $pendingCount,
            'pending_connections' => $pendingCount,
            'match_rate' => $matchRate . '%',
        ];
    }
}