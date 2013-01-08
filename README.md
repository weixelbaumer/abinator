ABinator
=======

ABinator is a flexible and powerful user behavior analysis tool.

* Define user segments and metrics in plain SQL.
* Compare the user segments against each other in terms of the metrics defined, with a Welch's t test (p-value)
* Provides dashboards to give a visual overview of the performance of the segments

It is used internally at Tradeshift to answer various hypotheses about the user population as well as for the analysis of AB experiments.

It is a very rough around the edges power tool. Use at your own risk.

## Requirements:

* Linux, Apache, MySql server
* PECL stats package (http://pecl.php.net/package/stats)
* Knowledge of SQL
* Access to database with BI data (incl. some concept of users with a unique id)

## Installation (incl. example data):

* Install PECL stats package
* Download and extract to <webroot>/abinator (or similar)
* Enable .htaccess in apache for <webroot>/abinator
* Create a database called abinator
* Edit app/Config/database.php to point to this database
* Go to <webroot>/app and run  "../lib/Cake/Console/cake schema create"
* Run app/Config/Schema/values.sql to insert some example data
* Go to http://host/abinator and click View
* You should see that 'Young users' are 46% worse than 'Old users' in terms of Total USD purchases, with a very low statistical confidence (p=0.577) which is reflected in the low opacity of the text

## Nomenclature:

* Segment: A group of users, e.g. 'users from x country', 'users with a public profile', etc. Can have a baseline segment defined, which is another segment to be compared to.
* Metric: A measure of performance (per user), e.g. 'total USD transacted', 'number of invites sent', etc. Bigger is better.
* Dashboard: A dashboard displays the performance of a set of segments against their baselines with regard to all metrics defined.

## Usage:

* Create a metric. The metric SQL must follow the template:

```
select
segment.userid,
<something numeric> as metric
from (%segment%) segment
<join to BI tables, etc. to get metric>
group by segment.userid
```

i.e. the SQL must select from the magic %segment% table (only contains a userid column) and return (userid, metric) grouped by segment.userid

* Create a segment. The segment SQL must follow the template:

```
select <something> as userid ... <some user filter, etc.>
```

i.e. the SQL must return (userid)

* Create a segment as above and choose the former segment as baseline
* Create and view a dashboard
* Add more metrics and segments

## Moving to real data:

* So far we've assumed you were testing it out locally. By now you should have a pretty good idea of how it works.
* ABinator requires that the abinator tables are in the same database as the BI data (for now).
* Either move the abinator tables to your BI DB (and change the database.php to reflect it) or copy the BI data to the abinator database periodically.
* The users and purchases tables that were created during installation were example data to get you started. They can safely be deleted.
* ABinator requires read/write access to the abinator tables and read access to the BI tables.
* Edit app/Model/User.php
Set useTable to the table containing the 'users' (customers, visitors or whatever the object is you are measuring performance on)
Set primaryKey to the column containing a unique id of the 'user'

## Notes

* For performance ABinator only updates metrics when a metric is changed! You can force an update by navigating to http://host/abinator/metrics/assign
* ABinator can use query-caching but it is disabled by default. You can enable it globally by setting $cache to true in app/Model/AppModel.php (don't) or enable it for a specific query by setting it right before the query, e.g.

```
public function getSegmentMetrics(){
    $this->cache = true;
    $segmentMetrics = $this->query("...");
}
```

Per default it caches queries for 24 hours. The value can be set in app/Model/AppModel.php

## Example installation (ubuntu)

everything as root:
```
$ pecl install stats
$ service apache2 restart
$ git clone git@github.com:Tradeshift/abinator.git /var/www/abinator
```

Put into /etc/apache2/sites-available/abinator:
<VirtualHost *:8081>
 DocumentRoot /var/www/abinator
 <Directory /var/www/t@github.com:Tradeshift/abinator.gitgit@github.com:Tradeshift/abinator.gitabinator>
  DirectoryIndex index.php index.html
  AllowOverride All
  Order allow,deny
  Allow from all
 </Directory>
</VirtualHost>

```
$ a2ensite abinator
```

Create mysql user:

```
CREATE USER 'abinator' IDENTIFIED BY 'ab12de';
CREATE DATABASE abinator;
GRANT ALL ON abinator.* TO 'abinator'@'localhost' IDENTIFIED BY 'ab12de';
```

Put this into app/Config/database.php:
<?php
class DATABASE_CONFIG {
    public $default = array(
        'datasource'  => 'Database/Mysql',
        'persistent'  => false,
        'host'        => 'localhost',
        'login'       => 'abinator',
        'password'    => 'ab12de',
        'database'    => 'abinator',
        'prefix'      => ''
    );
}
Create some temp dirs

```
$ mkdir -p tmp/logs tmp/cache/persistent tmp/cache/models
$ chown www-data.www-data tmp -R (make writeable by apache)
```

‘cake create schema’ will say it drops table on an empty database

$ mysql -u abinator -p abinator < Config/Schema/values.sql