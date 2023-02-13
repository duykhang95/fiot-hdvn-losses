function createDataTable(
  tableID,
  pagelength,
  searching,
  NO_RESULTS_TEXT,
  SEARCH_TEXT,
  NEXT_TEXT,
  PRE_TEXT
) {
  $("#" + tableID).DataTable({
    ordering: true,
    lengthChange: false,
    pageLength: pagelength,
    searching: searching,
    scrollX: false,

    // "scrollX": false,
    dom: '<"float-right"lf><"overflow-custom"t><"row m-0 p-0"<"col"i><"col"p>>',
    oLanguage: {
      sInfo: "_START_/_END_ [_TOTAL_]",
      // "sInfoEmpty": "Showing 0 to 0 of 0 entries",
      // "sInfoFiltered": "(filtered from _MAX_ total entries)",
      sZeroRecords: NO_RESULTS_TEXT,
      sInfoEmpty: "",
      sInfoFiltered: "",
      sSearch: SEARCH_TEXT,
      oPaginate: {
        sNext: NEXT_TEXT,
        sPrevious: PRE_TEXT,
      },
    },
  });
}

function disableBtn(btId) {
  $("#" + btId).attr("disabled", true);
  setTimeout(function () {
    // console.log(true);
    $("#" + btId).removeAttr("disabled");
  }, 1000);
}

function loadSelectbox(id_place, val) {
  valStrToArr = val.split(";");
  try {
    $("#" + id_place)
      .val(valStrToArr)
      .trigger("change"); //tag used select2
  } catch (error) {
    // console.log(error);
  }
}

function handleURL(url) {
  return url
    .replace(/[%]/g, "%25")
    .replace(/[+]/g, "%2B")
    .replace(/'/g, "%27")
    .replace(/ /g, "%20")
    .replace(/#/g, "%23")
    .replace(/[@]/g, "%40")
    .replace(/[$]/g, "%24")
    .replace(/[(]/g, "%28")
    .replace(/[)]/g, "%29");
}
function sendXmlHttpRequest(method, url, xmlhttp, link_get_data) {
  var link = handleURL(url);
  if (method == "POST") {
    xmlhttp.open(method, `${link_get_data}`);
    xmlhttp.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    xmlhttp.send(link, true);
  } else if (method == "GET") {
    xmlhttp.open(method, link, true);
    xmlhttp.send();
  }
}
