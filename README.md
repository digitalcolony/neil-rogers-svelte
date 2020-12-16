# The Neil Rogers Show

This is the Svelte rewrite of the [Neil Rogers website](https://neilrogers.org).

## Custom 404

The Svelte Custom 404 doesn't work right on the Sapper build, so I made a hack. There is a 404.svelte route that is linked to via a hidden link in the footer. Then on Apache, the 404 redirect is handled in the .htaccess file. In order for the image in the custom file to display, I had to use the full page to the server. The Svelte image path for the 404 error only worked on localhost.

If there is a better solution, my search skills failed me. The hacks I found did not work.

## Svelte notes

npx sapper dev (run dev server)
npx sapper export (build for FTP)
