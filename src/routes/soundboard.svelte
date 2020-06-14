<script>
  import { onMount } from "svelte";
  import Soundboard from "../components/Sboard.svelte";
  import SoundSearch from "../components/Search.svelte";
  import Meta from "../components/Meta.svelte";

  let searchTerm = "";
  let sounds = [];
  let displayList = [];

  onMount(async () => {
    const res = await fetch(`soundboard.json`);
    sounds = await res.json();

    // sort soundboard drops into alphabetical order based on drop name
    displayList = sounds.files.sort((a, b) => {
      if (a.name < b.name) return -1;
      if (a.name > b.name) return 1;
      return 0;
    });
  });

  function filterList(list, query) {
    displayList = sounds.files;
    return displayList.filter(item => {
      return (
        item.name.toLowerCase().match(query.toLowerCase()) ||
        item.artist.toLowerCase().match(query.toLowerCase())
      );
    });
  }
</script>

<svelte:head>
  <title>
    The Neil Rogers Soundboard - Play drops from Neil, Jim Mandich, Larry King,
    and More!
  </title>
  <link rel="canonical" href="https://neilrogers.org/soundboard/" />
  <meta
    name="description"
    content="Over 300 drops from the Neil Rogers show that you can play on your
    device." />
  <Meta />
</svelte:head>

<SoundSearch
  bind:searchTerm
  on:updateSearch={() => {
    displayList = filterList(sounds, searchTerm);
  }} />

<Soundboard bind:sounds={displayList} />

<p>
  The Simple Soundboard was coded using Svelte and is available for all to use
  on
  <a href="https://github.com/digitalcolony/simple-soundboard-svelte">
    GitHub.
  </a>
  There is also a
  <a href="https://github.com/digitalcolony/Simple-Soundboard">
    jQuery version.
  </a>

</p>
