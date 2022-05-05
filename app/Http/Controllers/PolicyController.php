<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

/**
 * Based on Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController
 */
class PolicyController extends Controller
{
    /**
     * Show the community guidelines for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function guidelines(Request $request)
    {
        $policyFile = Jetstream::localizedMarkdownPath('guidelines.md');

        $lastModified = Carbon::createFromTimestamp(filemtime($policyFile));

        return view('layouts.policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
            'lastModified' => $lastModified,
        ]);
    }

    /**
     * Show the privacy policy for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function privacy(Request $request)
    {
        $policyFile = Jetstream::localizedMarkdownPath('policy.md');

        $lastModified = Carbon::createFromTimestamp(filemtime($policyFile));

        return view('layouts.policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
            'lastModified' => $lastModified,
        ]);
    }

    /**
     * Show the terms of service for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function terms(Request $request)
    {
        $policyFile = Jetstream::localizedMarkdownPath('terms.md');

        $lastModified = Carbon::createFromTimestamp(filemtime($policyFile));

        return view('layouts.policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
            'lastModified' => $lastModified,
        ]);
    }
}
