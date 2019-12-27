# Changelog

All changes to this project will be documented in this changelog.

This project aheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

No changes have been made for future releases. 

## [alpha-0.0.1]

Initial alpha release

### Added

- ability to create public spylink
- spylink stats page 
    - accessible by adding a plus sign (+) at the end of a spylink
    - destination info (title of destination page and url the link redirects to)
    - date created info
    - total visits stats
    - total unique referrers stats
    - total unique browser stats
    - table with all stats
    - created by (since there's no registration, it always says anonymous user)
    - \# of links in the database

### Upcoming / Planned

- authenication (give people the ability to register/log in)
- admin dashboard
    - user management
        - ability to add/update/delete(disable) users
    - spylink management 
        - ability to update & delete
    - site settings
        - site information settings
        - site configuation settings
        - url configuration settings
            - ability to change spylinkid configuration
- user dashboard
    - user owned links management
    - edit existing spylink's destination url (maybe)
    - private spylinks
    - profile management
- spylink visitor's location data (country, region, ciy, zip, etc)
- more detailed spylink visitor's browser information
- better ipv4 and ipv6 support
- better platform support
- better url support
    - check if url has https and prefer https over http
    - website image support (snip an image of the url)
- public spylink directory (view all the active public links)

....and more.

Keep track of upcoming alpha features and enhancements [here](https://github.com/marchershey/SpyLink/projects/1). 