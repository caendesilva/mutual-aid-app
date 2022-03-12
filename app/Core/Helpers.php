<?php

if (!function_exists('chance')) {
    /**
     * Return true for $probability percent of the time.
     * @example chance(25) returns true 25% of the time.
     *
     * Has a ~0.003527512605377% mean deviation when running 10 000 000 iterations.
     *
     * @param int $probability factor in percent expressed as an integer between 0 and 99
     * @return bool
     */
    function chance(int $probability = 50): bool
    {
        return mt_rand(0, 99) < $probability;
    }
}
