<head>
<title>Connect PHP API test page</title>
</head>
<?
if (!defined('DOCROOT')) 
{
	$docroot = get_cfg_var('doc_root');
	define('DOCROOT', $docroot);
}
 
// Set up access control and authentication
require_once (DOCROOT . '/include/services/AgentAuthenticator.phph');

use RightNow\Connect\v1_3 as RNCPHP;

try{
    $answer = new RNCPHP\answer();
 
    /*Required fields for creating answer starts here---------------*/
    $answer->AnswerType = new RNCPHP\AnswerType();
    $answer->AnswerType->ID = 1;					
    /*
    Answer Type available are
    [HTML] => 1
    [URL] => 2
    [File Attachment] => 3
    */
						
    $answer->Language = new RNCPHP\NamedIDOptList();
    $answer->Language->ID = 1;					
    /*
    Language available are
    [en_US] => 1
    */
						
    $answer->Summary = " Answer created from connect-php code for testing purpose ";
    /*Required fields for creating answer ends here-----------------*/
						
    $answer->AccessLevels = new RNCPHP\AccessLevelArray();
    $answer->AccessLevels[0] = new RNCPHP\AccessLevel();
    $answer->AccessLevels[0]->ID = 2;					
    /*
    Access Levels present are
    [Help] => 2
    [Everyone] => 1
    */
						
    //Another answer with which this one should be associated
    //$answer->AssignedSibling = RNCPHP\Answer::fetch(1);
						
    //Staff member or group assigned to the answer
    //$answer->AssignedTo = new RNCPHP\GroupAccount();
    //$answer->AssignedTo->ID = 100520;
						
    //Add banner flag information
    $answer->Banner = new RNCPHP\Banner();
    $answer->Banner->ImportanceFlag = new RNCPHP\NamedIDOptList();
    $answer->Banner->ImportanceFlag->ID=1; //// [Low] => 1, [Medium] => 2, [High] => 3
    $answer->Banner->Text = "Banner flag test";
						
    //Add category (common to all sibling answers)
    $answer->Categories = new RNCPHP\ServiceCategoryArray();
    $answer->Categories[0] = RNCPHP\ServiceCategory::fetch(3);
						
    //Add comment about answer
    $answer->Comment = "Testing";
						
    // File attachments common to all sibling answers
    /*$answer->CommonAttachments =new RNCPHP\FileAttachmentSharedArray();
    $fattach = new RNCPHP\FileAttachmentAnswer();
    $fattach->ContentType = "text/text";
    $fp = $fattach->makeFile();
    fwrite($fp,"Making some notes in this text file for the answer".date("Y-m-d h:i:s"));
    fclose($fp);
    $fattach->FileName = "NewTextFilecommon".date("Y-m-d_h_i_s").".txt";
    $fattach->Name = "New Text File ".date("Y-m-d h:i:s").".txt";
    $answer->FileAttachments[] = $fattach;*/
 
    //Notes common to all sibling answers
    $answer->CommonComment = "Common comment for test answer";
						
    // Date on which the answer expires and is set to review status
    $answer->ExpiresDate = mktime(0, 0, 0, 11 , 11, 2012);
						
    //Array of file attachments for answer
    //$answer->FileAttachments =new RNCPHP\FileAttachmentAnswerArray();
    //Have to create new AnswerArray if common answer is not present.			
    /*$fattach = new RNCPHP\FileAttachmentAnswer();
    $fattach->ContentType = "text/text";
    $fp = $fattach->makeFile();
    fwrite($fp,"Making some notes in this text file for the answer file attach".date("Y-m-d h:i:s"));
    fclose($fp);
    $fattach->FileName = "NewTextFile".date("Y-m-d_h_i_s").".txt";
    $fattach->Name = "New Text File ".date("Y-m-d h:i:s").".txt";
    $answer->FileAttachments[] = $fattach;*/
						
    //Add Space-separated list of keywords associated with answer content
    $answer->Keywords = "Keyword1 keyword2";
						
    //Add notification time
    $answer->NextNotificationTime = mktime(0, 0, 0, 11 , 12, 2012);
						
    //Add notes associated with the answer
    $answer->Notes = new RNCPHP\NoteArray();
						
    //Add notes associated with the answer
    $answer->Notes[0] = new RNCPHP\Note();
    $answer->Notes[0]->Channel = new RNCPHP\NamedIDLabel();
    $answer->Notes[0]->Channel->LookupName = "Phone";
    $answer->Notes[0]->Text = "Sample answer Notes";
    $answer->Notes[1] = new RNCPHP\Note();
    $answer->Notes[1]->Channel = new RNCPHP\NamedIDLabel();
    $answer->Notes[1]->Channel->LookupName = "Email";
    $answer->Notes[1]->Text = "Sample answer Notes -1";
						
    //Added Reference number of the incident that was proposed to create this answer.
    $answer->OriginalReferenceNumber = "120924-000038";
						
    //Added ranking of the answer
    $answer->PositionInList = new RNCPHP\NamedIDOptList();
    $answer->PositionInList->ID = 1;					
    /*
    Ranking present are
    [Historical Usefulness] => 1
    [Place at Bottom] => 2
    [Place at Middle] => 3
    [Place at Top] => 4
    [Fix at Bottom] => 5
    [Fix at Middle] => 6
    [Fix at Top] => 7
    */
						
    //Added Products (common to all sibling answers)
    $answer->Products = new RNCPHP\ServiceProductArray(); //Have to create product
    $answer->Products[0] = RNCPHP\ServiceProduct::fetch(1);
						
    //Added Date on which the answer will be published, or made available to users
    $answer->PublishOnDate = mktime(0, 0, 0, 10 , 12, 2012);
						
    //Description or question portion of the answer
    $answer->Question = "Test Question";
						
    //Solution or answer portion of the answer
    $answer->Solution = "New solution";
						
    //Current status of the answer
    $answer->StatusWithType = new RNCPHP\StatusWithType();
    $answer->StatusWithType->Status->ID = 4;					
    /*
    Status available are
    [Private] => 5
    [Proposed] => 6
    [Public] => 4
    [Review] => 7
    */
						
    $answer->URL = "www.oracle.com";
    print_r($answer);
    $answer->save();
}
						
catch (Exception $err ){
    echo $err->getMessage();
}