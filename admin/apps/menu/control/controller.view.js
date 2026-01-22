$("#tblMenu tbody").sortable({
    handle: ".move-node",   // ใช้ anchor เป็นตัวลาก
    cursor: "move",
    axis: "y",              // ลากขึ้นลงเท่านั้น
    opacity: 0.8,
    helper: function(e, tr) {
        var originals = tr.children();
        var helper = tr.clone();
        helper.children().each(function(index) {
            $(this).width(originals.eq(index).width());
        });
        return helper;
    },
    update: function (event, ui) {
        // หลังลากเสร็จ
        let order = [];
        $("#tblMenu tbody tr").each(function(index){
            order.push({
                id: $(this).data("id"),
                position: index + 1
            });
        });

        console.log(order);
        // 👉 ส่ง ajax ไป update database ได้ตรงนี้
    }
}).disableSelection();