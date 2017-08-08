# wordpress plugin wsa allotment

Wordpress plugin for management of allotment entities. Designed summer 2017 for the new website of the Volkstuinvereniging Linnaeus.
In this plugin are the entities allotment related person (gardener) and allotment (garden) created related  
to Wordpress user and managed and used to restrict content.

## Plugin Features

* **Shortcodes:** Shortcodes to display private content related to a gardener or an alottment  
* **Crud operations:** Crud operations via admin screens of plugin.


## Copyright and License

This project is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

2017&thinsp;&ndash;&thinsp;2017 &copy; [Bram Waasdorp](http://www.waasdorpsoekhan.nl).

## Documentation

### The relationship of website-user, gardener, allotment and section

* **user** 		unique-key 	user_login, user_email
* **gardener**		unique-key	user_login, user_email
			foreign-key 	user_login, section, allotmentnr
* **allotment**		unique-key	section, allotmentnr 
* **section**		unique-key	section_id (= section in gardener and allotment)

### Shortcodes:
* **view_gardener**		displays a single gardner selected by user_login of user
* **view_allotment**		displays a single allotment selected by user_login of user
* **is_gardener**		displays content only when logged in user is a gardener
* **not_gardener**		displays content only when user is not logged in or is not a gardener  
* **has_allotment**		displays content only when logged in user is owner of (related to) an allotment
* **not_allotment**		displays content only when user is not logged in or is not owner of (related to) an allotment  

### Creates and updates:
Create, list view, updates and deletes via admin screens of plugin.
