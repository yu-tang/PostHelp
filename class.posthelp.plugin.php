<?php if (!defined('APPLICATION')) exit();

$PluginInfo['PostHelp'] = array(
   'Name' => 'PostHelp',
   'Description' => 'Add PostHelp section to discussion post page.',
   'Version' => '0.1.0',
   'RequiredApplications' => array('Vanilla' => '>=2.0.17'),
   'RequiredTheme' => FALSE, 
   'RequiredPlugins' => FALSE,
   'RegisterPermissions' => FALSE,
   'SettingsUrl' => FALSE,
   'SettingsPermission' => FALSE,
   'MobileFriendly' => FALSE,
   'HasLocale' => FALSE,
   'Author' => 'YU-TANG',
   // 'AuthorEmail' => 'author@example.com',
   'AuthorUrl' => 'https://github.com/yu-tang/',
   'License' => 'GNU GPLv2'
);

class PostHelpPlugin implements Gdn_IPlugin {

   /**
    * 1-Time on Enable
    */
   public function Setup() {
      // Clear the locale map cache.
      @unlink(PATH_CACHE.'/locale_map.ini');
   }


   /**
    * 1-Time on Disable
    */
   public function OnDisable() {
      // Clear the locale map cache.
      @unlink(PATH_CACHE.'/locale_map.ini');
   }


   /**
    * Add PostHelp css and js to post controller.
    */
   public function PostController_Render_Before($Sender) {
      $Sender->AddCssFile('posthelp.css', 'plugins/PostHelp/design');
      $Sender->AddJsFile('posthelp.js', 'plugins/PostHelp');
   }


   /**
    * Insert the PostHelp html.
    */
   public function PostController_BeforeFormInputs_Handler($Sender) {
      //$this->_injectPostHelp($Sender->EventArguments['Discussion']);
      $this->_injectPostHelp();
   }

   protected function _injectPostHelp($Discussion) {
      // Default PostHelp html from VanillaForums.org.
      // Change below to what you want.
?>
<div class="PostHelp">
      <div class="Help HelpTitle">
         <h4>How to Ask</h4>

         <ul>
            <li>We prefer questions that can be <em>answered</em>, not just discussed.</li>
            <li>Provide details.</li>
            <li>Write clearly and descriptively.</li>
         </ul>
         <div class="Examples">

            <div class="Example Bad"><strong>Bad:</strong> HELP!!!!!!</div>
            <div class="Example Good"><strong>Good:</strong> Error during install process: "no input file specified"</div>
         </div>
      </div>
      <div class="Help HelpFormat">
         <h4>How to Format</h4>

         <ul>
            <li>HTML is allowed</li>
            <li>Place code samples in &lt;code&gt; tags</li>
            <li>Provide details like:
               <ul>
                  <li>Exact error messages</li>

                  <li>Browser & version</li>
                  <li>PHP version</li>
                  <li>MySQL version</li>
               </ul>
            </li>
         </ul>
      </div>

      <div class="Help HelpTags">
         <h4>How to Tag</h4>
         <p>A tag is a keyword that categorizes your question with similar questions.</p>
         <ul>
            <li>When possible, use existing tags</li>
            <li>Favour popular tags</li>
            <li>Use common abbreviations</li>

            <li>Don't include synonyms</li>
            <li>Combine multiple words into a single word with dashes</li>
            <li>Max 5 tags</li>
            <li>Max 25 characters per tag</li>
            <li>Tag characters: a-z 0-9 + # _ .</li>
            <li>Separate tags with a space</li>

         </ul>
      </div>
   </div><?php 
   }

}
