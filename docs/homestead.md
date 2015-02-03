# Homestead

There are some great resources on this and as with most of these sections I will link to them before hand and not repeat what they already offer.

## Resources

[Matt Stauffer](http://mattstauffer.co/blog/introducing-laravel-homestead-2.0) does a great job going over Homestead.

[Laravel Docs](http://laravel.com/docs/master/homestead)

[Laracast](https://laracasts.com/search?q=homestead&q-where=lessons)


## Why Homestead?

### Lone developer
If you are a lone developer then maybe using your Mac or Linux box or Windows box would work. But even then having Beanstalkd ready to go, Nginx done just right, PHP, Composer etc all set to go. Plus no matter how much you work to perfect your install there is the chance your machine dies or gets stolen and there goes your perfect setup. (Backups rarely get this level of configuration backed up perfectly).

The following links will easily get you going. Once we get into Queues I will cover install the Beanstalkd ui.

### Team

There is no question you need Homestead or anything to unify your install base so new developers can ramp up in minutes not hours or days. Plus as noted above all the other advantages.


### Note

If you follow the direction / docs you will see how easy it is to set your Homestead.yml to the site and the database.

Then make sure to set your /etc/hosts file. BTW a good local domain ends in .dev seems to resolve faster than .local

Finally 

~~~
homestead up --provision
~~~~

to start it and 

~~~  
homestead halt 
~~~

before hand if needed.


