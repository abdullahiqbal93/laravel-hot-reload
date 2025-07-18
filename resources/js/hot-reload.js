const source = new EventSource('/hot-reload-stream');
source.onmessage = (event) => {
  if (event.data === 'reload') {
    console.log('🔁 Laravel Hot Reload triggered');
    window.location.reload();
  }
};
