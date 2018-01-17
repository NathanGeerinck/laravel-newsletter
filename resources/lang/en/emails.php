<?php

return [
    'dear' => 'Dear :name',

    //Campaigns
    'campaigns.send.subject' => 'Your campaign has been send!',
    'campaigns.send.text' => 'The campaign named _:campaign_ has been send successfully to :subscribers subscribers.',
    'campaigns.send.closing' => 'You\'re the master in sending ~~spam~~ newsletters!',

    //Lists
    'lists.imported.subject' => 'The import of subscriptions went successfully!',
    'lists.imported.text' => 'You\'ve imported the xls, xlsx or csv successfully in the mailing list named _:list:_',
    'lists.imported.button' => 'Go to :list',

    //Password
    'password.updated.subject' => 'You\'re password has been updated successfully',
    'password.updated.text' => 'You\'ve recently changed your password. If you have not done this yourself, we recommend that you contact the administrator.',
    'password.updated.closing' => 'You can improve the security of your account by enabling Two Factor authentication!',
    'password.updated.button' => 'Enable Two Factor Authentication',

    //2FA
    '2fa.enabled.subject' => 'Two Factor Authentication has been enabled!',
    '2fa.enabled.text' => 'You\'ve recently enabled authentication with Google Two Factor Authentication. A step closer to worldwide security!',
    '2fa.enabled.button' => 'Get the Google Authenticator app',
    '2fa.enabled.backupcodes' => 'We also generated 5 backup codes that you can use when you are unable to use the Google Authenticator app:',
    '2fa.disabled.subject' => 'Two Factor Authentication has been disabled!',
    '2fa.disabled.text' => 'You\'ve recently disabled authentication with Google TwoFactor Authentication. If this wasn\'t you, please contact the system administrator.',
];
