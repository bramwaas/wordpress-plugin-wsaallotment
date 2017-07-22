# wordpress plugin wsa allotment

Wordpress plugin for management of allotment entities. Designed summer 2017 for the new website of the Volkstuinvereniging Linnaeus.
In this plugin are the entities allotment related person (gardener) and allotment (garden) created related  
to Wordpress user and managed and used to restrict content.

## Plugin Features

* **Shortcodes:** Shortcodes to display and to update private content related to a gardener or an alottment  


## Copyright and License

This project is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

2009&thinsp;&ndash;&thinsp;2017 &copy; [Bram Waasdorp](http://www.waasdorpsoekhan.nl).

## Documentation

### The relationship of website-user, gardener and allotment

user 		unique-key 	emailaddress
gardener	unique-key	emailaddress
			foreign-key section, allotmentnr
allotment	unique-key	section, allotmentnr 

### Shortcodes:
view_gardener		displays a single gardner selected by emailaddress of user
view_allotment		displays a single allotment selected by emailaddress of user
update_gardeners	displays a list of gardners selected by criteria; and update an item from the list or create a new.
update_allotments	displays a list of allotments selected by criteria; and update an item from the list or create a new.
is_gardener			displays content only when user is a gardener
not_gardener		displays content only when user is not a gardener  
is_allotment_owner	displays content only when user is owner of (related to) an allotment
not_allotment_owner	displays content only when user is not owner of (related to) an allotment  