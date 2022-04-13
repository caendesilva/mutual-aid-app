# Contributing

Contributions are **welcome** and will be fully **credited**.

Please read and understand the contribution guide before creating an issue or pull request.

## Etiquette

This project is open source, and as such, the maintainers give their free time to build and maintain the source code
held within. They make the code freely available in the hope that it will be of use to other developers. It would be
extremely unfair for them to suffer abuse or anger for their hard work.

Please be considerate towards maintainers when raising issues or presenting pull requests. Let's show the
world that developers are civilized and selfless people.

It's the duty of the maintainer to ensure that all submissions to the project are of sufficient
quality to benefit the project. Many developers have different skill sets, strengths, and weaknesses.
Respect the maintainer's decision, and do not be upset or abusive if your submission is not used.

## Viability

When requesting or submitting new features, first consider whether it might be useful to others.
Open source projects are used by many developers, who may have entirely different needs to your own.
Think about whether or not your feature is likely to be used by other users of the project of it could
be better suited as a fork or add-on extension.

## Procedure

Before filing an issue:

- Attempt to replicate the problem, to ensure that it wasn't a coincidental incident.
- Check to make sure your feature suggestion isn't already present within the project.
- Check the pull requests tab to ensure that the bug doesn't have a fix in progress.
- Check the pull requests tab to ensure that the feature isn't already in progress.

Before submitting a pull request:

- Check the codebase to ensure that your feature doesn't already exist.
- Check the pull requests to ensure that another person hasn't already submitted the feature or fix.

## Requirements

If the project maintainer has any additional requirements, you will find them listed here.

We try to follow the Laravel standards, https://laravel.com/docs/9.x/contributions#coding-style

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](https://pear.php.net/package/PHP_CodeSniffer).
(https://github.com/squizlabs/PHP_CodeSniffer)
```bash
# Example usage
phpcs --standard=ruleset.xml
```

**Please add tests!**
- **Add tests!** - Your patch might not be accepted if it doesn't have tests.

- **Document any change in behavior** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](https://semver.org/). Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests as that makes it easier to maintain.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful.
  If you had to make multiple intermediate commits while developing, please
  [squash them](https://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Development

### Testing
Please add tests for all features implemented, and always run the tests before submitting a PR.
```bash
php artisan test
```

### Coding Style
We use the PSR2 coding standard and the PSR-4 autoloading standard.

If you have CodeSniffer, use the following command to ensure your code follows the PSR2 standard.
```bash
phpcs --standard=ruleset.xml
```

## Which branch?
Development on upcoming features is done on the `master` branch. The `master` branch is hooked up to the staging environment and is not production ready and may be unstable its API may change at any time without prior notice.

The `release` branch is used to track the current stable release and is hooked up to the production environment. The `release` branch must be stable and follow [SemVer v2.0.0](https://semver.org/).

So, which branch should you use?

You should almost always use the `master` branch for development.  The maintainer will review your pull request and determine if it is a feature request or a bug fix.

If you are submitting a compatible bug fix or patch, then you may submit it to both branches, or to `master` and make a note that you are submitting a patch intended to be merged into `release`.

### Building Assets
> This section is based on the [Official Laravel Contribution Guide](https://laravel.com/docs/9.x/contributions#compiled-assets)

If you are submitting a change that will affect a compiled file, such as most of the files in resources/css or resources/js of the, do not commit the compiled files.
Due to their large size, they cannot realistically be reviewed by a maintainer. This could be exploited as a way to inject malicious code into the app.
In order to defensively prevent this, all compiled files will be generated and committed by the maintainers.


**Happy coding**!
