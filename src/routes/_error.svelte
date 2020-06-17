<script>
  import Image from "svelte-image";
  import Meta from "../components/Meta.svelte";
  export let error;

  const dev = process.env.NODE_ENV === "development";
</script>

<style>
  figure {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  p {
    text-align: center;
  }
</style>

<svelte:head>
  <title>404 - Page Not Found</title>
  <meta name="robots" content="noindex,nofollow" />
  <Meta />
</svelte:head>
<p>
  The page you are looking for does not exist. Return to the
  <a href="/">Home Page.</a>
</p>
<figure>

  <Image src="images/neil-sigh.jpg" alt="Neil Rogers page not found" />
  <figcaption>Neil Rogers</figcaption>
</figure>

{#if dev && error.stack}
  <p>{error.message}</p>
  <pre>{error.stack}</pre>
{/if}
