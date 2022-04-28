<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
* @deprecated v1.3.7
*/
class GitHubWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * Signature validation code based on https://github.com/amezmo/github-webhook-validation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        file_put_contents(base_path('webhook.log'), "\n\n ". now() .
        ": Incoming webhook. Validating signature.", FILE_APPEND);

        if (($signature = $request->headers->get('X-Hub-Signature')) == null) {
            throw new BadRequestHttpException('Header signature not set');
        }

        $knownToken = config('services.github_webhook_secret');

        $signatureParts = explode('=', $signature);

        if (count($signatureParts) !== 2) {
            file_put_contents(base_path('webhook.log'), PHP_EOL . 'Signature has invalid format', FILE_APPEND);
            throw new BadRequestHttpException('Signature has invalid format');
        }

        $knownSignature = hash_hmac('sha1', $request->getContent(), $knownToken);

        if (!hash_equals($knownSignature, $signatureParts[1])) {
            file_put_contents(
                base_path('webhook.log'),
                PHP_EOL . 'Could not verify request signature ' . $signatureParts[1],
                FILE_APPEND
            );

            throw new UnauthorizedHttpException('Could not verify request signature ' . $signatureParts[1]);
        }

        file_put_contents(base_path('webhook.log'), "\n ". now() .
        ": Signature valid. Proceeding.\n", FILE_APPEND);

        file_put_contents(base_path('webhook.log'), "\n ". now() .
        ": Fetching origin.\n", FILE_APPEND);

        $output = shell_exec('git fetch -v');

        file_put_contents(base_path('webhook.log'), "\n ". now() .
        ": Output: $output\n", FILE_APPEND);

        file_put_contents(base_path('webhook.log'), "\n ". now() .
        ": All done. Acknowledging request.\n", FILE_APPEND);

        return response('200, Acknowledged.', 200);
    }
}
