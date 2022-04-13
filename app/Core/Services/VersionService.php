<?php

namespace App\Core\Services;

class VersionService
{
    public static function gitBranch()
    {
        try {
            return trim(shell_exec('git branch --show-current')) ?: '';
        } catch (\Throwable $th) {
            return '';
        }
    }
    
    public static function gitVersion(): string
    {
        try {
            return trim(shell_exec('git describe --tags --abbrev=0')) ?: 'unreleased';
        } catch (\Throwable $th) {
            return 'unreleased';
        }
    }

    public static function gitCommit(): string
    {
        try {
            return trim(shell_exec('git rev-parse --short HEAD')) ?: '';
        } catch (\Throwable $th) {
            return '';
        }
    }

    // Check difference between current branch and origin branch
    public static function gitDiff(): string
    {
        try {
            $status = shell_exec('git status -bs --porcelain');

            if (!str_contains($status, '[')) {
                // @todo add branch check as it returns Master for all branches
                return "Up to date with Origin/Master.";
            }

            $status = substr($status, 0, strpos($status, ']') + 1);

            $status = str_replace('## ', '', $status);

            $status = explode('...', $status);

            $branch = ucfirst($status[0]);

            $status = explode(' [', $status[1]);
            $status[1] = rtrim($status[1], ']');

            $originBranch = ucwords($status[0], '/');

            $diff = explode(' ', $status[1]);
            $diffVerb = $diff[0];
            $diffCount = $diff[1];

            $commits = $diffCount <= 1 ? 'commit' : 'commits';

            return "On branch $branch. $diffCount $commits $diffVerb $originBranch.";
        } catch (\Throwable $th) {
            return '';
        }
    }
}
