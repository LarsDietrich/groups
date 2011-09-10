/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var groupid;


$('document').ready(function(){
   groupid = $('input[name="groupid"]').val(); 
   $('a#events').click(getGroupEvents);
   $('a#members').click(getGroupMembers);
});

function getGroupEvents()
{
   
    $.get("/Groups/group/events/groupid/"+groupid+"/format/html",function(data){
       $('div.ajaxdata').html(data);
    });
    return false;
}

function getGroupMembers()
{
    $.get("/Groups/member/members/groupid/"+groupid+"/format/html",function(data){
        $('div.ajaxdata').html(data);
    });
    
    return false;
}