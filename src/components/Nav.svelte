<script>
  export let segment;
</script>

<style>
  nav {
    border-bottom: 0px solid rgba(255, 62, 0, 0.1);
    font-weight: 300;
    padding: 0 1em;
  }

  ul {
    margin: 0;
    padding: 0;
  }

  /* clearfix */
  ul::after {
    content: "";
    display: block;
    clear: both;
  }

  li {
    display: block;
    float: left;
  }

  [aria-current] {
    position: relative;
    display: inline-block;
    color: black;
  }

  [aria-current]::after {
    position: absolute;
    content: "";
    width: calc(100% - 1em);
    height: 2px;
    background-color: rgb(51, 12, 70);
    display: block;
    bottom: -1px;
  }

  a {
    text-decoration: none;
    padding: 1em 0.5em;
    display: block;
  }
  a:active {
    color: black;
  }
</style>

<nav>
  <a aria-current={segment === undefined ? 'page' : undefined} href=".">Home</a>
  <ul>

    <li>
      <a
        aria-current={segment === 'audio' ? 'page' : undefined}
        href="audio/"
        rel="prefetch">
        Audio
      </a>
    </li>
    <li>
      <a
        aria-current={segment === 'timeline' ? 'page' : undefined}
        href="timeline/"
        rel="prefetch">
        Timeline
      </a>
    </li>
    <li>
      <a
        aria-current={segment === 'docs' ? 'page' : undefined}
        href="docs/"
        rel="prefetch">
        Docs
      </a>
    </li>
    <li>
      <a
        aria-current={segment === 'soundboard' ? 'page' : undefined}
        href="soundboard/"
        rel="prefetch">
        Soundboard
      </a>
    </li>
    <!-- for the blog link, we're using rel=prefetch so that Sapper prefetches
		     the blog data when we hover over the link or tap it on a touchscreen -->
    <!-- <li><a rel=prefetch aria-current="{segment === 'blog' ? 'page' : undefined}" href="blog">blog</a></li> -->
  </ul>
</nav>
{#if segment === undefined}
  <h1>The Neil Rogers Show</h1>
{:else if segment === 'audio'}
  <h1>Download, Stream or Torrent Audio</h1>
{:else if segment === 'timeline'}
  <h1>Neil Rogers Timeline</h1>
{:else if segment === 'docs'}
  <h1>Docs</h1>
{:else if segment === 'docs'}
  <h1>Docs</h1>
{:else if segment === 'soundboard'}
  <h1>Neil Rogers Soundboard</h1>
{:else}
  <h1>Other</h1>
{/if}
