<?php
if(!isset($_SESSION['login']))
{
    header('Location: index.php');
	exit;
}
?> 
<table width="189" border="0" cellpadding="5"   cellspacing="1"  bordercolor="#000000">



<tr>
    <td bgcolor="#3c7701"><strong>
    <div class="white">Advertise</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='main-slider.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Main Slider</td>
</tr>
<tr>
<td class="menuleft"  onclick="window.location.href='premium-ad.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Premium Ad</td>
</tr>

<tr>
<td class="menuleft"  onclick="window.location.href='homepage-ad.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Home Page Ad</td>
</tr>

<tr>
<td class="menuleft"  onclick="window.location.href='search-page-ad.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Search Page Ad</td>
</tr>

<tr>
<td class="menuleft"  onclick="window.location.href='product-discription-ad.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Product Discription Ad</td>
</tr>

<tr>
<td class="menuleft"  onclick="window.location.href='congratulation-ad.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Congratulation Ad</td>
</tr>

<tr >
    <td bgcolor="#3c7701"><strong>
    <div class="white">Manage Client</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='view-clients.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">View Clients</td>
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='add-new-client.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Ada New Client</td>
</tr>

<tr >
    <td bgcolor="#3c7701"><strong>
    <div class="white">Manage Menus</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='view_menu.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">View Menu</td>
</tr>

<tr>
<td class="menuleft"  onclick="window.location.href='add_menu.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Add New Menus</td>
</tr>
<tr >
    <td bgcolor="#3c7701"><strong>
    <div class="white">Manage Pages</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft"  onclick="window.location.href='view_static_page.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">View Pages</td>
</tr>
<tr>
<td class="menuleft"  onclick="window.location.href='add_static_page.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">Add New Page</td>
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
    <div class="white">Manage Contact Us</div>
    </strong></td> 
</tr>
<tr>
    <td class="menuleft" onclick="window.location.href='view_right_link.php'"  onmouseover="this.className='menuleftover';" onmouseout="this.className='menuleft';">View Contact Us</td>
</tr>
<tr>
    <td bgcolor="#3c7701"><strong>
      <div class="white">Admin Options</div>
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