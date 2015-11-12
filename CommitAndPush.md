# Introduction #

These are brief instructions for how to make a commit and clean push to the repo after making local changes to your codebase.

# Adding a new file #
To add a new file to be tracked, use
```
$ hg add <file1> <file2>
```
DO NOT use a blanket add( `$ hg add`) as this will add some hidden files that track how your project is set up locally, and could potentially interfere with operation in other developers' environment.

If you accidentally add some of these hidden files, you can use
```
$ hg forget <file>
```
prior to a commit to remove file from the list of files to be committed.
If you have accidentally added and committed these hidden files, use
```
$ hg remove <file>
```
To remove the file from tracking, and then re-commit.

# Commit #

Prior to a push, you should make sure that your local branch is committed by checking
```
$ hg status
```
If this returns no lines with M, then your current branch is committed.
If there is a line with M, e.g.
```
$ hg status
M foobar.php
```
then you need to commit your current work by using
```
$ hg ci
```
and enter a commit message into VIM, then press ESC :wq ENT
or use
```
$ hg ci -m 'your message here'
```
to commit without needing to enter VIM.

# Push #

From your source code directory, run
```
$ hg pull
$ hg merge
```
Deal with any differences that Mercurial cannot automatically handle.
Once the merge is successful, you will need to commit the merged branch with
```
$ hg ci
```
or
```
$ hg ci -m 'your message'
```
Finally, run
```
$ hg push https://yourcoderepo.com
```
And enter your username and password for the repo.
You can also add the following lines to your ~/.hgrc
```
[auth]
pushSite.prefix = https://yourcoderepo.com
pushSite.username = yourname@yoursite.com
pushSite.password = passwordforcommitting
pushSite.schemes = http https
```
Where pushSite is an identifier to link all of this information together, and can be any word.