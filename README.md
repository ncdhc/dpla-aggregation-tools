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

**jQuery TableSorter** <http://tablesorter.com/docs/>