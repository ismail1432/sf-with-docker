<?php


namespace App\Legacy;


use App\Legacy\Entity\SynchronizeInterface;

class QueryTransformer
{
    /**
     * Convert Default DB Query To Legacy Field Query.
     *
     * @example for Beneficiary.
     *
     * $originalQuery = ['active' => 1, 'observation' => 'simple example', 'lastName' => 'Smaine']
     * will output ['client_actif' => 1, 'client_observation' => 'simple example', 'client_nom' => 'Smaine']
     */
    public function convert(SynchronizeInterface $synchronize): ?array
    {
        $totalItems = count($synchronize);
        $changes = 0;
        foreach ($synchronize->getMapping() as $legacy => $mapping) {
            // Stop if all fields are converted to legacy field or $originalQuery is empty.
            if ($changes === $totalItems) {
                break;
            }

            $field = $mapping['name'] ?? $mapping;

            if (array_key_exists($field, $originalQuery)) {
                $legacyField = $mapping['legacyName'] ?? $legacy;

                $originalQuery[$legacyField] = $originalQuery[$field];

                unset($originalQuery[$field]);
                ++$changes;
            }
        }

        return $originalQuery;
    }
}
