// const axios = require('axios');

// function sendLineMessage(taskName) {
//   // สร้างข้อความที่ต้องการส่ง
//   const message = `รายละเอียดงาน: ${taskName}`;

//   // ใส่รหัสกลุ่ม LINE ของคุณที่นี่
//   const lineGroupId = 'U14d8e02fd35407e29f2322fcb80b03af';

//   // ส่งข้อความไปยังกลุ่ม LINE
//   sendLineGroupMessage(lineGroupId, message);
// }

// function sendLineGroupMessage(groupId, message) {
//   // ส่งคำขอ HTTP POST ไปยัง URL ของ LINE Messaging API
//   // เพื่อส่งข้อความไปยังกลุ่ม LINE
//   // โดยแนบ groupId และ message ในตัวข้อความที่ส่ง
//   // คุณจำเป็นต้องดูแลการส่งคำขอ HTTP POST ในภาษาหรือโค้ดที่คุณใช้
//   // เพื่อให้สามารถส่งข้อความไปยัง LINE Messaging API ได้

//   // ตัวอย่างโค้ดที่อาจใช้งาน
//   axios.post('https://api.line.me/v2/bot/message/push', {
//     to: groupId,
//     messages: [
//       {
//         type: 'text',
//         text: message,
//       },
//     ],
//   }, {
//     headers: {
//       'Content-Type': 'application/json',
//       'Authorization': '+lUtivE5VWYecFuHdN8J7JfbUxoaOuQGX5159MNoFHQ2+XBQVL4YEI4b1mJW+tPq5DSuyQ1+UyNuu2sBQDbLXaRijZrCDdvwzeqWpdZQ/Qhf50oUP5yOOmqMrjZttd+l7TRihSG3XEKZ7oROnYsUSgdB04t89/1O/w1cDnyilFU=',
//     },
//   })
//     .then(function(response) {
//       console.log('Message sent successfully');
//     })
//     .catch(function(error) {
//       console.error('Failed to send message:', error);
//     });
// }



