(function() {
  // ตัวช่วยจัดการสถานะรายการเมลใน inbox
  const wrapper = document.querySelector('#mail-item-wrapper')
  const bulkMail = document.querySelector('#bulk-mail')
  const allToggle = document.querySelector('[data-check="all-toggle"]')
  const checkboxes = '.mail-item input[type="checkbox"]'
  const btnStarred = '.btn-starred'
  const mailCheckboxes = '[data-toggle="mail-checkbox"]'

  // เลือกทั้งหมด
  function checkAll() {
    for (const el of wrapper.querySelectorAll(checkboxes + ':not(:checked)')) {
      el.click()
    }
  }

  // ยกเลิกเลือกทั้งหมด
  function uncheckAll() {
    for (const el of wrapper.querySelectorAll(checkboxes + ':checked')) {
      el.click()
    }
  }

  // เลือกเฉพาะเมลที่อ่านแล้ว
  function checkRead() {
    uncheckAll()
    for (const el of wrapper.querySelectorAll('.mail-item:not(.unread) input[type="checkbox"]')) {
      el.click()
    }
  }

  // เลือกเฉพาะเมลที่ยังไม่อ่าน
  function checkUnread() {
    uncheckAll()
    for (const el of wrapper.querySelectorAll('.mail-item.unread input[type="checkbox"]')) {
      el.click()
    }
  }

  // เลือกเฉพาะเมลที่ติดดาว
  function checkStarred() {
    uncheckAll()
    for (const el of wrapper.querySelectorAll('.mail-item.starred input[type="checkbox"]')) {
      el.click()
    }
  }

  // เลือกเฉพาะเมลที่ไม่ได้ติดดาว
  function checkUnstarred() {
    uncheckAll()
    for (const el of wrapper.querySelectorAll('.mail-item:not(.starred) input[type="checkbox"]')) {
      el.click()
    }
  }

  // sync class checked ให้ตรงกับ checkbox
  function checkedClass() {
    for (const el of wrapper.querySelectorAll(checkboxes)) {
      const item = el.closest('.mail-item')
      el.checked ? item.classList.add('checked') : item.classList.remove('checked')
    }
  }

  // sync ปุ่ม all-toggle ตามจำนวนที่เลือก
  function checkedAllToggle() {
    const total = wrapper.querySelectorAll(checkboxes).length
    const checked = wrapper.querySelectorAll(checkboxes + ':checked').length
    total == checked ? allToggle.checked = true : allToggle.checked = false
  }

  // แสดง/ซ่อน bulk action เมื่อมีการเลือกเมล
  function toggleBulk() {
    const checked = wrapper.querySelectorAll(checkboxes + ':checked').length
    checked ? bulkMail.removeAttribute('hidden') : bulkMail.setAttribute('hidden', true)
  }

  // sync class starred ของรายการเมลจากปุ่มดาว
  function toggleStarred() {
    for (const el of wrapper.querySelectorAll(btnStarred)) {
      const item = el.closest('.mail-item')
      el.classList.contains('active') ? item.classList.add('starred') : item.classList.remove('starred')
    }
  }

            // router สำหรับคำสั่งเลือกเมลจาก data-check
            function mailCheckbox(el) {
              switch (el.dataset.check) {
                case 'all':
                  checkAll();
                  break;
                case 'none':
                  uncheckAll();
                  break;
                case 'read':
                  checkRead();
                  break;
                case 'unread':
                  checkUnread();
                  break;
                case 'starred':
                  checkStarred();
                  break;
                case 'unstarred':
                  checkUnstarred();
                  break;
                case 'all-toggle':
                  el.checked ? checkAll() : uncheckAll();
                  break;
              }
            }

            // event delegation สำหรับคลิกในหน้า inbox
            document.addEventListener('click', e => {
              if (e.target.closest(checkboxes)) {
                checkedClass()
                checkedAllToggle()
                toggleBulk()
              }
              if (e.target.closest(btnStarred)) {
                toggleStarred()
              }
              if (e.target.closest(mailCheckboxes)) {
                mailCheckbox(e.target.closest(mailCheckboxes))
              }
            })

})()

          // ตั้งค่า editor สำหรับ compose mail
          $('.summernote').summernote({
            dialogsInBody: true,
            height: 150,
            placeholder: 'Write your message here',
            toolbar: [
              ['font', ['bold', 'underline', 'italic']],
              ['insert', ['link', 'picture', 'fullscreen']],
            ],
          })

          