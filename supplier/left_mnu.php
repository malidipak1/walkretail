<?php
if(!isset($_SESSION['login']))
{
    header('Location: index.php');
	exit;
}
?> 
<table width="189" border="0" cellpadding="5"   cellspacing="1"  bordercolor="#000000">

<tr >
    <td bgcolor="#3c7701"><strong>
    <div class="white">Manage Profile</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='clients-profile.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">View Profile</td>
</tr>
<tr >
    <td bgcolor="#3c7701"><strong>
    <div class="white">Manage Product</div>
    </strong></td> 
</tr>

<tr>
    <td class="menuleft"  onclick="window.location.href='clients-profile.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Add Product</td>
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='clients-profile.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Product List</td>
</tr>

<!--<tr>
    <td bgcolor="#3270B4"><strong>
    <div class="white">Manage Home page text</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft" onclick="window.location.href='view_right_link1.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Manage Home Page</td>
</tr>-->

<tr>
    <td bgcolor="#3c7701"><strong>
      <div class="white">Settings</div>
      </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='change_email_id.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Change Email Id</td>
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='change_password.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Change Password</td>
</tr>
<tr>
   <td class="menuleft" onclick="window.location.href='logout.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Sign Out </td>
</tr>
</table>