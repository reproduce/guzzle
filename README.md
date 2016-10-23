# Guzzle issue reproduction

This repo contains code that reproduces certain issues.

Every issue is on a separate branch (like `issueXYZ`) with a README file explaining the issue and/or containing references.


## Starting a new reproduction

First you need to create a new orphan branch:

``` bash
$ git checkout --orphan issueXYZ
```

Or if there is no concrete issue yet, then use a name like `this_has_happened`.
But having an issue in the [Guzzle issue tracker](https://github.com/guzzle/guzzle/issues) is preferred.
