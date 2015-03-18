# Symfony Coding Standard

WIP

Trying to fill the gaps of other symfony standards.

http://symfony.com/doc/current/contributing/code/standards.html

This has tests to ensure that the symfony coding standard is actually fulfilled.

At the moment this are the things missing:

Structure
* Declare class properties before methods
* Declare public methods first, then protected ones and finally private ones.
The exceptions to this rule are the class constructor and the setUp and tearDown methods of PHPUnit tests,
which should always be the first methods to increase readability;
* Exception message strings should be concatenated using sprintf.

Naming Conventions
* Suffix exceptions with Exception
