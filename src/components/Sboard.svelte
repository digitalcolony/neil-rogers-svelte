<script>
  export let sounds;

  function playSound(mp3) {
    const sound = new Audio(mp3.mp3);
    sound.play();
  }
</script>

<style>
  button {
    -moz-box-shadow: 3px 4px 0px 0px #9fb4f2;
    -webkit-box-shadow: 3px 4px 0px 0px #9fb4f2;
    box-shadow: 3px 4px 0px 0px #9fb4f2;
    background: -webkit-gradient(
      linear,
      left top,
      left bottom,
      color-stop(0.05, #7892c2),
      color-stop(1, #476e9e)
    );
    background: -moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);
    background: -webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
    background: -o-linear-gradient(top, #7892c2 5%, #476e9e 100%);
    background: -ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
    background: linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
    background-color: #7892c2;
    -moz-border-radius: 18px;
    -webkit-border-radius: 18px;
    border-radius: 18px;
    border: 1px solid #4e6096;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: arial;
    font-size: 17px;
    padding: 7px 25px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #283966;
    margin: 3px;
  }
  button:hover {
    background: -webkit-gradient(
      linear,
      left top,
      left bottom,
      color-stop(0.05, #476e9e),
      color-stop(1, #7892c2)
    );
    background: -moz-linear-gradient(top, #476e9e 5%, #7892c2 100%);
    background: -webkit-linear-gradient(top, #476e9e 5%, #7892c2 100%);
    background: -o-linear-gradient(top, #476e9e 5%, #7892c2 100%);
    background: -ms-linear-gradient(top, #476e9e 5%, #7892c2 100%);
    background: linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#476e9e', endColorstr='#7892c2',GradientType=0);
    background-color: #476e9e;
    color: yellow;
  }
  button:active {
    position: relative;
    top: 1px;
  }
</style>

{#each sounds as { name, artist, mp3 }}

  <span class="track">
    <button class="mybutton" title={artist} on:click={() => playSound({ mp3 })}>
      {name}
    </button>
  </span>
{:else}
  <p>No sounds match the query or you are offline.</p>
{/each}
