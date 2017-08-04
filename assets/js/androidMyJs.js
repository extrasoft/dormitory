function KeyCode(objId)
{
  if (event.keyCode >= 48 && event.keyCode<=57 || event.keyCode >= 65 && event.keyCode<=90 || event.keyCode>=97 && event.keyCode<=122) //48-57(ตัวเลข) ,65-90(Eng ตัวพิมพ์ใหญ่ ) ,97-122(Eng ตัวพิมพ์เล็ก) ,161-206(Th ตัวอักษรไทย)
  {
    return true;
  }
  else
  {
    alert("กรอกได้เฉพาะตัวอักษรภาษาอังกฤษหรือตัวเลขเท่านั้น [A-Z],[a-z],[0-9]");
    return false;
  }
}

function NameCode(objId)
{
  if ((event.keyCode >= 48 && event.keyCode<=57)) //48-57(ตัวเลข) ,65-90(Eng ตัวพิมพ์ใหญ่ ) ,97-122(Eng ตัวพิมพ์เล็ก) ,161-206(Th ตัวอักษรไทย)
  {
    alert("กรอกได้เฉพาะตัวอักษรภาษาไทยหรือภาษาอังกฤษเท่านั้น [A-Z],[a-z],[ก-ฮ]");
    return false;
  }
  else
  {
    return true;
  }
}

function isPhoneNo(input){
  if ((event.keyCode >= 48 && event.keyCode<=57))
  {
    return true;
  }
  else
  {
    alert("กรอกเบอร์โทรศัพท์ได้เฉพาะตัวเลขเท่านั้น [0-9]");
    return false;
  }
}
