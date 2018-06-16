<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
  /* 选区设置 */
  ::selection {
      background: rgba(27,162,227,.2);
      color: inherit;
  }
  /* 滚动条设置 */
  ::-webkit-scrollbar {
    width: 10px;
    height: 10px; }

  ::-webkit-scrollbar-button {
    width: 0;
    height: 0; }

  ::-webkit-scrollbar-button:start:increment, ::-webkit-scrollbar-button:end:decrement {
    display: none; }

  ::-webkit-scrollbar-corner {
    display: block; }

  ::-webkit-scrollbar-thumb {
    border-radius: 8px;
    background-color: rgba(0, 0, 0, 0.2); }

  ::-webkit-scrollbar-thumb:hover {
    border-radius: 8px;
    background-color: rgba(0, 0, 0, 0.5); }

  ::-webkit-scrollbar-track, ::-webkit-scrollbar-thumb {
    border-right: 1px solid transparent;
    border-left: 1px solid transparent; }

  ::-webkit-scrollbar-track:hover {
    background-color: rgba(0, 0, 0, 0.15); }

  ::-webkit-scrollbar-button:start {
    width: 10px;
    height: 10px;
    background: url(./assets/scrollbar_arrow.png) no-repeat 0 0; }

  ::-webkit-scrollbar-button:start:hover {
    background: url(./assets/scrollbar_arrow.png) no-repeat -15px 0; }

  ::-webkit-scrollbar-button:start:active {
    background: url(./assets/scrollbar_arrow.png) no-repeat -30px 0; }

  ::-webkit-scrollbar-button:end {
    width: 10px;
    height: 10px;
    background: url(./assets/scrollbar_arrow.png) no-repeat 0 -18px; }

  ::-webkit-scrollbar-button:end:hover {
    background: url(./assets/scrollbar_arrow.png) no-repeat -15px -18px; }

  ::-webkit-scrollbar-button:end:active {
    background: url(./assets/scrollbar_arrow.png) no-repeat -30px -18px; }
</style>
