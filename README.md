# Frameworkless PHP

Whilst frameworks offer clarity, removing the encessity for writing repetetive code, enforcing clean practices, and allowing for speedy development of complex applications, they are not as required for writing PHP applications as they once were.

Modern PHP offers a variety of features including, routing, error handling, environment variables, and more through the use of easy to use libraries using the package manager Composer (now considered and industry standard).

## Cases for frameworkless PHP

Sometimes a framework may be overkill, a project might be small, not require the full set of features provided by a framework, or you may be working on somehting like a library, addon, or plugin. In these cases frameworkless PHP may be a good option. 

Building a frameworkless application can seem daunting. Many people do not know where to start, being used to writing procedural PHP which is difficult to maintain, and does not adhere to [clean-code](https://www.amazon.co.uk/Clean-Code-Handbook-Software-Craftsmanship/dp/0132350882)/[SOLID](https://en.wikipedia.org/wiki/SOLID) principles.

# Chapters

1. [Front Controller](/README/front-controller.md)
2. [Composer](/README/composer.md)
3. [Error Handling & DotEnv](/README/error-handling.md)
4. [HTTP](/README/http.md)


# Why make this?

As someone who is interested in improving my own codings skills I wanted to develop my programming knowledge and skills further. Having used Laravel in a working environment I realised my understanding of some framework components was lacking. In order to gain a greater insight I built my own basic framework. Still, I wondered how it may be possible to build a frameworkless project in a reasonable time. To build a basic MVC framework took a few days working throughout my evenings after work, "There must be a better solution", and there is! I scoured the internet for examples, but found very few articles on the topic, eventually discovering the book by Patrick Louys. I found this book to be most helpful, exactly what I wanted, many articles focusing on frameworkless projects ignored clean-code or OOP best practices, Partick Louys balances practicality of quickly setting up projects with modern practices for writing clean, maintainable, updatable applications using pure PHP. 

If you have not read his book I strongly suggest you put it on your reading list. This tutorial does not contain the same information, whilt I include additional things for my own setup I wrote this tutorial to solidify information in my own mind, and as a way to explain writing pure PHP applications to others. 

# Mentions

Inspired by Patrick Louys [Professional PHP: Building maintainable and secure applications](https://www.amazon.co.uk/Professional-PHP-Building-maintainable-applications/dp/198347598X/ref=sr_1_1?dchild=1&keywords=Professional+php&qid=1607024984&s=books&sr=1-1)

# Liscence 

Copyright 2020 PlanetDebug

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
