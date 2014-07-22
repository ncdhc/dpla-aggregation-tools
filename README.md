DPLA OAI Aggregation Tools
==========================

These tools are intended for use by Digital Public Library of America _Service Hubs_ and _Content Hubs_ tasked with aggregating content into a master OAI feed for harvest by the DPLA (http://dp.la).

These tools help staff evaluate incoming **Dublin Core** feeds in three ways:
  - Displaying data that is mapped to each of the simple Dublin Core fields [DC MAPPING CHECKER]
  - Displaying the frequency of terms in each simple Dublin Core fields [DC FACET VIEWER]
  - Displaying records that are missing DPLA "required" fields [REQUIRED DATA CHECKER]

Support for other incoming metadata formats is planned but not provided at this time.

Version
-------

1.0

Technology
----------

DPLA OAI Aggregation Tools require the following to work properly:
  - PHP 5 or higher
  - libxml extension (enabled in PHP 5 by default)
  - php_curl extension
  - php_xsl extension

Installation
------------

Unzip files into a web-accessible directory or local evironment. Visit:

```sh
http://[path_to_your_directory]/index.php
```

License
-------

DPLA OAI AGGREGATION TOOLS 1.0

Copyright (C) 2014 North Carolina Digital Heritage Center <http://www.digitalnc.org/about>.

This program is free software: you can redistribute it and/or modify
it under the terms of the **GNU General Public License** as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses>.

Attribution
-----------

**jQuery** <https://jquery.com>

    Copyright 2005, 2014 jQuery Foundation and other contributors,
    https://jquery.org/
    
    This software consists of voluntary contributions made by many
    individuals. For exact contribution history, see the revision history
    available at https://github.com/jquery/jquery
    
    The following license applies to all parts of this software except as
    documented below:
    
    ====
    
    Permission is hereby granted, free of charge, to any person obtaining
    a copy of this software and associated documentation files (the
    "Software"), to deal in the Software without restriction, including
    without limitation the rights to use, copy, modify, merge, publish,
    distribute, sublicense, and/or sell copies of the Software, and to
    permit persons to whom the Software is furnished to do so, subject to
    the following conditions:
    
    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
    LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
    OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
    WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
    
    ====
    
    All files located in the node_modules and external directories are
    externally maintained libraries used by this software which have their
    own licenses; we recommend you read them, as their terms may differ from
    the terms above.


**jQuery TableSorter** <http://tablesorter.com/docs/>

    The MIT License (MIT)
    
    Copyright (c) 2014 Christian Bach
    
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