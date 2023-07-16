// เมื่อคลิกที่ปุ่มดาวน์โหลด PDF
document.getElementById("btn-download").addEventListener("click", function() {
    // ดึงข้อมูลจากฐานข้อมูลผ่านการโหลดข้อมูลจาก API หรืออื่น ๆ
    // ในตัวอย่างนี้ฉันจะใช้ข้อมูลจำลองเป็นตัวอย่าง

    // ข้อมูลที่จะใช้สร้างเอกสาร PDF
    var data = {
      task: [
        { task_ID: 1, task_name: "Task 1", task_customer: 1 },
        { task_ID: 2, task_name: "Task 2", task_customer: 2 },
        { task_ID: 3, task_name: "Task 3", task_customer: 1 }
      ],
      customer: [
        { cus_ID: 1, cus_name: "Customer 1", cus_type: "Type A" },
        { cus_ID: 2, cus_name: "Customer 2", cus_type: "Type B" }
      ],
      member: [
        { mem_ID: 1, mem_name: "Member 1" },
        { mem_ID: 2, mem_name: "Member 2" }
      ]
    };

    // สร้างเนื้อหาของเอกสาร PDF
    var content = [];

    // เพิ่มข้อมูลจากตาราง task
    content.push({ text: "Tasks", style: "header" });
    for (var i = 0; i < data.task.length; i++) {
      var task = data.task[i];
      var customer = data.customer.find(function(c) {
        return c.cus_ID === task.task_customer;
      });
      var member = data.member.find(function(m) {
        return m.mem_ID === task.task_men;
      });
      content.push(
        "- " + task.task_name + " (Customer: " + customer.cus_name + ", Member: " + member.mem_name + ")"
      );
    }

    // สร้างเอกสาร PDF
    var docDefinition = {
      content: content
    };

    // สร้างไฟล์ PDF และดาวน์โหลด
    pdfmake.createPdf(docDefinition).download("document.pdf");
  });