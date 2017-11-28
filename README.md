# Data structures 

[![Build Status](https://img.shields.io/travis/jitesoft/php-datastructures/master.svg?label=master)](https://travis-ci.org/jitesoft/php-datastructures)  

[![Build Status](https://img.shields.io/travis/jitesoft/php-datastructures/develop.svg?label=develop)](https://travis-ci.org/jitesoft/php-datastructures)

[![Dependency Status](https://gemnasium.com/badges/github.com/jitesoft/php-datastructures.svg)](https://gemnasium.com/github.com/jitesoft/php-datastructures)

[![codecov](https://codecov.io/gh/jitesoft/php-datastructures/branch/master/graph/badge.svg)](https://codecov.io/gh/jitesoft/php-datastructures)

A package consisting of a mix of data structures, classes and algorithms I find useful for php 7.1+.  

Usage of data structures does not necessarily speed up the end product, but it could very well help in the development process.  
The native array type in php can be a pain to keep track of what it is, is it a indexed or associative? Is it supposed to be a queue or a list?
Well, by using a data structure as `LinkedQueue` or `IndexedList` this becomes a bit easier.  
The structures all have methods to add and remove objects and works pretty much as one is used to with the type of structure they represent.
  
The package is a work in progress and new things will be added over time.  
If you got a specific request, feel free to add a query through the [issue tracker](https://github.com/jitesoft/php-datastructures/issues).

## Installation and Usage.

Either clone the repository or require the package from composer:

```
composer require jitesoft/datastructures
```

Usage is quite self-explanatory, if not, feel free to add a issue for further documentation in the  [issue tracker](https://github.com/jitesoft/php-datastructures/issues).
  
## Currently implemented classes.

The following classes are currently implemented:  
* Static classes (`Jitesoft\DataStructures`)
  * `Arrays`      - Static array methods.
  * `Maps`        - Static map methods.
* List types (`Jitesoft\Utilities\DataStructures\Lists`)
  * `IndexedList` - A indexed list implementation wrapping the native array.
  * `LinkedList`  - A indexed list implementation as a linked list.
  * Sorting   (`Jitesoft\Utilities\DataStructures\Lists\Sorting`)
    * `AbstractSort` - Class used to implement user defined sorting methods.
    * `NativeSort`   - A implementation of the `AbstractSort` using `usort`.
    * `GnomeSort`    - A implementation of the `AbstractSort` using the Gnome sort sorting algorithm.
    * `QuickSort`    - A implementation of the `AbstractSort` using the Quick sort sorting algorithm.
* Queue types (`Jitesoft\Utilities\DataStructures\Queues`) (FiFo queue)
  * `LinkedQueue` - A queue implementation with a linked list as base.
  * `ArrayQueue`  - A queue implementation with an array as base.
* Stack types (`Jitesoft\Utilities\DataStructures\Stacks`) (LiFo queue)
  * `LinkedStack` - A stack implementation with a linked list as base.
  * `ArrayStack`  - A stack implementation with an array as base.
* Grid types (`Jitesoft\Utilities\DataStructures\Grids`)
  * `Grid`        - A grid implementation with a IndexedList as container.
* Map types (`Jitesoft\Utilities\DataStructures\Maps`)
  * `SimpleMap`   - A simple map structure wrapping the native array.


### Deprecated

### Removed

All math classes have been moved to its own project and repository at [github](https://github.com/jitesoft/php-math).

## Development & Contributions.

Pull requests following the given code-standard (check `ruleset.xml`) with 100% coverage by tests will be reviewed for merge.  
Any contributions is greatly appreciated!

## License.

```text
MIT License

Copyright (c) 2017 JiteSoft

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
