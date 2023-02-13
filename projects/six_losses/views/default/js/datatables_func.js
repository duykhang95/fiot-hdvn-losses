function createDataTable(tableID, pagelength, searching) {
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
            sZeroRecords: "Không tìm thấy kết quả",
            sInfoEmpty: "",
            sInfoFiltered: "",
            sSearch: "Tìm kiếm:",
            oPaginate: {
            sNext: "Trang kế",
            sPrevious: "Trang trước",
            },
        },
    });
}