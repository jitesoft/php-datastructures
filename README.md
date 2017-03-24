# Data structures 
_master:_  
[![Build Status](https://travis-ci.org/jitesoft/php-datastructures.svg?branch=master)](https://travis-ci.org/jitesoft/php-datastructures)  

_develop:_  
[![Build Status](https://travis-ci.org/jitesoft/php-datastructures.svg?branch=development)](https://travis-ci.org/jitesoft/php-datastructures)

A package consisting of a mix of data structures I find useful for php 7.1+.  

Usage of data structures does not necessarily speed up the end product, but it could very well help in the development process.  
The native array type in php can be a pain to keep track of what it is, is it a indexed or associative? Is it supposed to be a queue or a list?
Well, by using a data structure as `LinkedQueue` or `IndexedList` this becomes a bit easier.  
The structures all have methods to add and remove objects and works pretty much as one is used to with the type of structure they represent.
  
The package is a work in progress and new type of structures will be added over time.  

#### Installation and Usage.
Either clone the repository or require the package from composer:
```
composer require jitesoft/datastructures
```
Usage is quite self-explanatory, if not, feel free to add a issue for further documentation in the issue tracker.
  
#### Currently implemented classes.
The following classes are currently implemented:  

* List types (`Jitesoft\Utilities\DataStructures\Lists`)
  * `IndexedList` - a indexed list implementation wrapping the native array.
  * `LinkedList`  - a indexed list implementation as a linked list.
* Queue types (`Jitesoft\Utilities\DataStructures\Queues`) (FiFo queue)
  * `LinkedQueue` - A queue implementation with a linked list as base.
  * `ArrayQueue`  - A queue implementation with an array as base.
* Stack types (`Jitesoft\Utilities\DataStructures\Stacks`) (LiFo queue)
  * `LinkedStack` - A stack implementation with a linked list as base.
  * `ArrayStack`  - A stack implementation with an array as base.
#### Development & Contributions.
Pull requests following the given code-standard (check `ruleset.xml`) with 100% coverage by tests will be reviewed for merge.  
Any contributions is greatly appreciated!

#### License.
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
