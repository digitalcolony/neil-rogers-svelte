<script>
  import Nav from "../components/Nav.svelte";
  import Footer from "../components/Footer.svelte";
  export let segment;
</script>

<header>
  <Nav {segment} />
</header>
<main>
  <slot />
</main>
<Footer />
