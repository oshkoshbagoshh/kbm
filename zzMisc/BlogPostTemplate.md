---
title: Cleaning Up Data for the Front End - PHP's Unsung Role in Doing the "dirty work" that no one else wanted to do"
published: false
description:
tags: PHP, HTML, Web Development, Technology, JavaScript, Servers, Databases, CI/CD, CyberSecurity
cover_image:
canonical_url:
---

# Post title

## Post body

// takes in an input of an associative array
// processed articles will be what I do with them after using array , string manip
// what we want to eventually have is a clean data class that is easily formulaic and repeatable
// so the the same amount of posts , same data comig in, etc.
// PHP is all about keeping the site up and running so its dealing with all the edge cases most people don't even think about
// most of this stuff is so abstracted away now it's definite'y last of a dying breed
// we should also write it to a file to be safe.
// we'll start with cleaning up the data for any edge cases that will cause probs in SQL statements
// then we will write getters and setters for our Controllers
// we can establish relationships to them via Models, and then for our views we will keep it simple

// just a listing of articles, 3 x 3 on desktop, 1 x 1 on mobile.
// need to build a simple Admin Panel for creating and editing articles based on role.
// I have the following roles:
/\*\*

-
- AJ - READ, WRITE, UPDATE, EDIT, DELETE
- MIKE - READ, WRITE, UPDATE, EDIT
- JANELLE - READ, WRITE, UPDATE,
- JEFF - READ, WRITE,
- KAMRON - READ, EDIT ONLY - (like an editor)
-
- \*/
