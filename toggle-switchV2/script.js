function filterme(value) {
    value = parseInt(value, 10); // Convert to an integer
    if (value === 1) {
      $('#custom-toggle').removeClass('tgl-off', 'tgl-def').addClass('tgl-on');
      $('span').text('Enabled');
    } else if (value === 2) {
      $('#custom-toggle').removeClass('tgl-on, tgl-off').addClass('tgl-def');
      $('span').text('Undetermined');
    } else if (value === 3) {
      $('#custom-toggle').removeClass('tgl-def', 'tgl-on').addClass('tgl-off');
      $('span').text('Disabled');
    }
  }