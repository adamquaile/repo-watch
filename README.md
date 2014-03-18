# repo-watch

**This is a work in progress, and not suitable for production use**

Split into 2 parts, one to recognise various repository events, like:

 - a tag being created
 - new commits being pushed

from various sources such as:

 - events via Github service hooks
 - cronjob checking
 - etc..

And another part to perform actions based on those events, such as

 - emailing a changelog to your team
 - updating build status
 - etc..

