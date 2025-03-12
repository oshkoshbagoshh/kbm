<?php

/**========================================================================
 *                             Form 
 *  
 *   - form submission to allow uploading of files 
 *   - validate file type, duplicates, etc.
 * - sanitize output
 * - CSRF ,
 *  - Sql injection 
 * -  save to /uploads folder , and rename the file
 *   - Required: Title, URL,  markdown, category needs to be split into tags
fallback user in case there isn’t one
 *  
 *========================================================================**/
 