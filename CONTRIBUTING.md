# Contributing to the Peanut Butter 2015 theme


This file documents some workflows for development of the theme, tips for
compiling resources (like Sass) and also some ideas about development
environemnts that might be helpful.

Target versions:

* WordPress: **4.1.1**
* MySQL: ?
* PHP: ?


## Workflows

### l33t hacking workflow (best case scenario):

1. Run a local install of WP (see ideas below under development environment) that uses this theme.
2. Hack your changes in. 
3. Commit your changes (according to Github flow, using feature branches, etc.)
4. ... continue work ...
5. Deploy to alpha site. You will need SSH access to server.

    Deploy the current commit by using the `deploy-alpha.sh` script in this repo.

       ./deploy-alpha.sh


Advantages: 

* Everything is version controlled
* Releases can be rolled back
* Deployment isn't too difficult
* Advances take place in a testing environment


### pwned hacking workflow (worst case scenario):

1. Access production server via FTP/SFTP
2. Edit files live on server. 
3. Save

Disadvantages: 

* No version control; i.e. flying without a parachute
* Updates will be overwritten next time someone deploys
* Changes directly to CSS will be overwritten next time Sass is compiled


## Compiling Sass

Both the raw Sass and compiled CSS are version controlled, so if you want to 
hack the CSS then you should hack the Sass and compile otherwise when someone 
else comes along and attempts to hack from Sass all your changes to CSS will
be unwittingly overwritten.

You can compile the Sass with this command: 

    sass sass/style.scss:style.css

You can also watch the directory for any changes to Sass files with:

    sass --watch sass/style.scss:style.css


## Development environment

It's best to have a local development environment. Honestly, most environemnts
will work, but sometimes it's nice to have something that easy to setup for
everyone involved, portable and reproducible. To that end, one option you 
have is to use Vagrant to set up a local virtual server that runs a web server
and MySQL server and loads up WordPress for you. 

Since WordPress is really popoular, there are lots of people out there thinking
about these types of things and there are some tools to help you set up 
WordPress on Vagrant really quickly. One of the best supported of these is:

* [Varying Vagrant Vagrants](https://github.com/Varying-Vagrant-Vagrants/VVV) (VVV)

(I know the naming sucks.) 

There's a command line tool to help automate setting up new WP test sites:

* [Variable VVV](https://github.com/bradp/vv)

After getting a site setup to work on this theme you can then create a 
symbolic link to pull in your local developing copy of this theme.

    ln -s [path to git repo] [path to intallation of vvv]/www/pb2015/htdocs/wp-content/themes/pb2015
