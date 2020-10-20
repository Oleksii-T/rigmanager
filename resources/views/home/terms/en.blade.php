@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/components/tos_pp.css')}}" />
@endsection

@section('content')
    <article class="article" id="termsWraper">
        <h1 class="page-header">{{__('ui.footerTerms')}}</h1>
        <div class="p">
            <h2 class="ph"><span class="pn">1</span> GENERAL PROVISIONS</h2>
            <p class="pb"><span class="pn">1.1</span> RIGMENGER Ltd. (hereinafter referred to as the <span class="key">Contractor</span> and/or the <span class="key">Company</span>) publishes this Public Agreement (<span class="key">Agreement</span> and/or <span class="key">Offer</span>) on the Provider's website <a class="body-link" href="{{route('home')}}">{{route('home')}}</a>.</p>
            <p class="pb"><span class="pn">1.2</span> In accordance with article 633 of the Civil Code of Ukraine, this <span class="key">Agreement</span> is a public contract, and in the case of acceptance of the following conditions, any capable individual or legal entity (hereinafter <span class="key">User</span>) undertakes to comply with the conditions of this <span class="key">Agreement</span>.</p>
            <p class="pb"><span class="pn">1.3</span> In this offer, unless the context requires otherwise, the following terms have the following meanings:</p>
            <ul class="pbl">
                <li><span class="key">Offer</span> - a public offer of the <span class="key">Provider</span>, addressed to any сapable Individuals' and / or legal entity, to conclude with him a Public Agreement on service provision on the conditions contained in this Agreement, including all its annexes;</li>
                <li><span class="key">Acceptance</span> - complete acceptance of the terms and conditions of the <span class="key">Agreement</span> by the <span class="key">User</span>;</li>
                <li><span class="key">Contractor</span> - PUBLIC JOINT STOCK COMPANY "RIGMANGER", legal address: 7 Mira Str., Poltava, Ukraine, 36022;</li>
                <li><span class="key">Website/Sites</span> - Internet site <a class="body-link" href="{{route('home')}}">{{route('home')}}</a>, administered by the <span class="key">Company</span>, which is a communication platform for placing temporary classified notices (hereinafter referred to as the <span class="key">Website</span> and/or <span class="key">Sites</span>);</li>
                <li><span class="key">User</span> - any capable individual or legal entity that has accepted the terms and conditions of this <span class="key">Agreement</span> and uses the <span class="key">Company</span>'s services. The Site is used on behalf of a legal entity by an authorised employee/representative of such legal entity;</li>
                <li><span class="key">Good/Product</span> - any tangible or intangible object;</li>
                <li><span class="key">Service</span> - any transaction which is related to the provision of the service and which is consumed in the process of performing a certain action or performing a certain activity to meet the personal needs of the customer;</li>
                <li><span class="key">rigmanager.com.ua services</span> - any paid and free services provided by the <span class="key">Contractor</span> through the <span class="key">Sites</span> (for example, including, but not limited to, all its capabilities, text, data, information, software, graphics or photographs, drawings, etc.), as well as any other services provided by the <span class="key">Company</span> through the services of the <span class="key">Sites</span>.</li>
                <li><span class="key">Account/account</span> - an user account of the <span class="key">User</span> created by the User and belonging to the Executor in the functional system of the Sites, with the help of which he can manage his posts on the <span class="key">Sites</span>. The <span class="key">account</span> may only be used by one <span class="key">User</span>, the transfer of data for access to the <span class="key">account</span> to another <span class="key">User</span> (another person) is not permitted;</li>
                <li><span class="key">Registration</span> - acceptance by the <span class="key">User</span> of an offer to conclude this <span class="key">Agreement</span> and the procedure, in the course of which the <span class="key">User</span> by filling in the relevant forms of the <span class="key">Website</span> provides the necessary information for the use of the <span class="key">Website</span> services. The Registration shall be deemed completed only if all stages of the Registration are successfully completed in accordance with the instructions published on the <span class="key">Website</span>.</li>
                <li><span class="key">Personal data</span> - information or a set of information about a individual person, which can be identified or can be specifically identified with their help.</li>
                <li><span class="key">EMAIL-verification</span> - the verification of the <span class="key">User</span>, which is carried out by clicking the relevant link indicated in the EMAIL notification sent by the Company to the e-mail address specified by the <span class="key">User</span> on the Registers page or in the Account.</li>
                <li><span class="key">Publish/To Post/To Place</span> - <span class="key">User</span> action - publication or activation of a single post. Publishing is also a change in an existing post if such a change involves changing and/or adding goods, changing the essential characteristics of the goods, changing the region.</li>
            </ul>
            <p class="pb"><span class="pn">1.4</span> If the <span class="key">User</span> does not agree with the <span class="key">Agreement</span> in whole or in part, the Contractor asks them to leave this website. These terms and conditions regulate the <span class="key">User</span>'s use of <span class="key">Websites</span> and <span class="key">rigmanager.com.ua services</span>. Use of the <span class="key">rigmanager.com.ua services</span> means that the User has read this Agreement, understands and accepts its terms. The rights and obligations of the Parties, rules for using the Websites may also be contained in the articles of the User Support Centre, materials posted on the Website (or links to which are posted on the Website). Such articles and materials are an integral part of the Agreement.</p>
            <p class="pb"><span class="pn">1.5</span> Starting to use any rigmanager.com.ua service , by going through the registration procedure, the User confirms their legal capacity and acceptance of the terms of the Agreement in full, without any reservations or exceptions. In case the User disagrees with any of the provisions of this Agreement, the User is not entitled to use the rigmanager.com.ua services.</p>
            <p class="pb"><span class="pn">1.6</span> The Company hereby offers the Internet Users to use their services under the conditions set out in this Agreement.</p>
            <p class="pb"><span class="pn">1.7</span> The Company offers the User services to use the Websites publish information about goods or services for the purpose, including, but not limited to, subsequent purchase or sale of various goods and services by other Users.</p>
            <p class="pb"><span class="pn">1.8</span> All transactions are made between Users directly and only. Thus, the Company is not a party to any transactions of Users, but only provides a communication trading platform for placing posts.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">2</span> POST PUBLICATION</h2>
            <p class="pb"><span class="pn">2.1</span> The User is entitled publish posts on the Sites after passing the EMAIL-verification.</p>
            <p class="pb"><span class="pn">2.2</span> The User also has the right to register to the Sites for additional services by filling out a form with a valid e-mail address to which only the User has access, mobile phone number and other data required for registration. The User will then be able to undergo EMAIL-verification.</p>
            <p class="pb"><span class="pn">2.3</span> The User has the right to create an account and log in to the Website using their Facebook or Google account data. The user who is not registered on the Website must enter his or her account data (login and password) on Facebook or Google upon request and then he or she will be able to use the services of the Website. By registering on the Website through a Facebook or Google connection, the User provides the Company with additional personal data. Detailed information on personal data provided to the Company and processed by the Company can be found in <a class="body-link" href="{{loc_url(route('privacy'))}}">Privacy Policy</a> of this website.</p>
            <p class="pb"><span class="pn">2.4</span> The use of the features and services of the Websites, both registered and unregistered Users, means that the User undertakes to follow the rules and instructions for using the rigmanager.com.ua services, including this Agreement.</p>
            <p class="pb"><span class="pn">2.5</span> The User is responsible for all activities using their e-mail address, mobile phone number and password to access the Sites. The User has the right to use the services of the Sites only by means of his/her own e-mail address, mobile phone number and password. In case of transfer of data for access to the account/account to another User (other person), such account/account may be blocked at the discretion of the Administration.</p>
            <p class="pb"><span class="pn">2.6</span> The User undertakes to keep the password confidential and not disclose it to third parties.</p>
            <p class="pb"><span class="pn">2.7</span> The User shall immediately change the data to access the Sites if they have reasons to suspect that their e-mail address, telephone number and password used to access the Sites have been disclosed or can be used by third parties.</p>
            <p class="pb"><span class="pn">2.8</span> The User who publishes posts for the sale of goods or services on the Websites undertakes to publish information about them in accordance with this Agreement and the instructions provided on the Websites, and provide accurate and complete information about goods or services and the conditions of their sale. By posting information about a product or service, the User confirms that they have the right to sell this product or provide this service in accordance with the requirements of the legislation of the countries where it is sold.</p>
            <p class="pb"><span class="pn">2.9</span> The User guarantees that the goods/services offered to them comply with the quality standards established by the laws of the countries for which they are sold and are free from claims of third parties.</p>
            <p class="pb"><span class="pn">2.10</span> The User guarantees that the services offered to them, if they require special permission, will be performed in accordance with the requirements of the legislation of the countries whose special bodies will be authorised to supervise such activities of the User.</p>
            <p class="pb"><span class="pn">2.11</span> The User is obliged to carefully check all information about goods and services published on the Websites and, if incorrect information is found, add the necessary information to the description of the goods or service. If this is not possible, correct the incorrect information by cancelling the post and re-posting the information about the product or service.</p>
            <p class="pb"><span class="pn">2.12</span> The description of the post prepared by the User shall not contradict this Agreement and the applicable laws of the countries for which they are implemented.</p>
            <p class="pb"><span class="pn">2.13</span> The User undertakes not to provide active support or disseminate information about services provided by competitors of the Contractor, including but not limited to:</p>
            <ul class="pbl">
                <li>Information about other message boards, trading platforms, online auctions and/or online shops;</li>
                <li>Internet resources offering goods and services prohibited for sale on the Sites.</li>
            </ul>
            <p class="pb"><span class="pn">2.14</span> The Company has the right to move, complete or extend the period of demonstration of a User's post for technical reasons that are under the Company's control or not. The Company has the right to terminate the demonstration of an post if the User has registered a product or service in violation of the terms of this Agreement or the applicable law.</p>
            <p class="pb"><span class="pn">2.15</span> The User is prohibited:</p>
                <p class="pb psb"><span class="pn">2.15.1</span> Publish the same post from the same e-mail address / mobile phone number;</p>
                <p class="pb psb"><span class="pn">2.15.2</span> Publish post with similar content where it is obvious that the same offer is involved;</p>
                <p class="pb psb"><span class="pn">2.15.3</span> To duplicate identical posts from the same e-mail address / mobile phone number;</p>
                <p class="pb psb"><span class="pn">2.15.4</span> Publish posts under a heading that does not correspond to the content of the post;</p>
                <p class="pb psb"><span class="pn">2.15.5</span> Publish posts with repeated punctuation marks and/or non-letter symbols in their title;</p>
                <p class="pb psb"><span class="pn">2.15.6</span> Publish posts whose description and/or title/photos are unrelated and unreadable;</p>
                <p class="pb psb"><span class="pn">2.15.7</span> Publish posts offering several goods and services simultaneously;</p>
                <p class="pb psb"><span class="pn">2.15.8</span> Insert links in the post to resources that contain malicious elements or links to the main page of the site;</p>
                <p class="pb psb"><span class="pn">2.15.9</span> Publish an post about a product or service if such post may lead to a violation of law enforcement regulations;</p>
                <p class="pb psb"><span class="pn">2.15.10</span> Publish an post about a good or service that does not include or relate to the Oil and Gas sphere in Ukraine.</p>
                <p class="pb psb"><span class="pn">2.15.11</span> posts must correspond to the geographic area and city selected in the respective functional settings of the Websites.</p>
                <p class="pb psb"><span class="pn">2.15.12</span> Indication of incorrect characteristics of the subject of the offer in the post. Including the indication of a price that does not correspond to the actual sale price of a product or service. The price must be indicated in full for the entire product or service.</p>
                <p class="pb psb"><span class="pn">2.15.13</span> The title of the post must correspond to the text of the post itself and must not contain contact or personal information about the User (telephone, e-mail, Internet resource address)</p>
                <p class="pb psb"><span class="pn">2.15.14</span> A photo showing the goods/services offered by the User for sale must correspond to the title and text of the post. The photo must only show the object offered for sale. Stock photos and/or photos uploaded from the Internet are not allowed to be published in posts of private Users.</p>
                <p class="pb psb"><span class="pn">2.15.15</span> It is permitted to publish one post concerning one specific object, property, service.</p>
                <p class="pb psb"><span class="pn">2.15.16</span> posts may be selectively checked or premoderated by the Company's representatives.</p>
                <p class="pb psb"><span class="pn">2.15.17</span> It is prohibited to publish any post advertising a sale: </p>
                <ul class="pbl psbl">
                    <li>alcoholic beverages;</li>
                    <li>cigarettes and tobacco products;</li>
                    <li>narcotic substances and precursors;</li>
                    <li>pornographic materials or items;</li>
                    <li>pharmacological products, medicines;</li>
                    <li>stolen, non-legally obtained goods;</li>
                    <li>items that pose a danger to life and health;</li>
                    <li>goods that do not exist;</li>
                    <li>human and animal organs;</li>
                    <li>special technical means of secretly obtaining information;</li>
                    <li>state awards;</li>
                    <li>personal documents as well as the forms of these documents;</li>
                    <li>databases;</li>
                    <li>firearms, cold and traumatic weapons, as well as ammunition and their components;</li>
                    <li>special means of active defence used by law enforcement agencies;</li>
                    <li>walrus canines, elephant tusks and mammoth tusks not in the product, as well as precious metals and precious stones not in the product;</li>
                    <li>rare and prohibited animals, including animals listed in the CITES international convention (on trade in rare and endangered species of flora and fauna;</li>
                    <li>any other goods and services prohibited by applicable law.</li>
                </ul>
                <p class="pb psb">The Company has the right to remove posts at the request of the rights holder or competent state authorities. The Company also reserves the right to delete any posts that in its opinion do not comply with the principles and rules of public morality. The decision to delete is final and cannot be appealed.</p>
            <p class="pb"><span class="pn">2.16</span> The Website Administration and moderators (Company representatives) have the right to do so:</p>
                <p class="pb psb"><span class="pn">2.16.1</span> Introduce spelling and punctuation corrections into the User's post text that do not affect the general meaning of the post content;</p>
                <p class="pb psb"><span class="pn">2.16.2</span> Transfer posts to other categories of the Websites in case a more appropriate category is identified for their post;</p>
                <p class="pb psb"><span class="pn">2.16.3</span> Refuse to publish posts if they do not correspond to the subject of the selected sections or violate this Agreement, as well as limit the number of posts from one User for the convenience of using the Sites without explanation.</p>
                <p class="pb psb"><span class="pn">2.16.4</span> To facilitate interaction between Users, the Company may establish limited access to contact information of other Users. The right to use information provided by other Users is limited by this Agreement.</p>
                <p class="pb psb"><span class="pn">2.16.5</span> The Company is not responsible for the content of posts or hyperlinks to resources specified in the description of posts of Users.</p>
                <p class="pb psb"><span class="pn">2.16.6</span> The subject of posts may be goods or services the sale of which is not prohibited or restricted under the laws of the country in which they are sold, and which are not contrary to this Agreement.</p>
            <p class="pb"><span class="pn">2.17</span> For analizing the number of published posts per unit, 1 (one) Post is accepted.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">3</span> CONDITIONS FOR PROCESSING PERSONAL DATA OF USERS AND CONSENT TO IT</h2>
            <p class="pb"><span class="pn">3.1</span> When placing posts, Site users grant the Company the right to process their personal data on the terms and conditions provided in <a class="body-link" href="{{loc_url(route('privacy'))}}">Privacy Policy</a> of this website.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">4</span> INFORMATION PROVIDED BY THE USER</h2>
            <p class="pb"><span class="pn">4.1</span> The Company reserves the right to contact the User: to send information messages to the electronic specified during registration, as well as to send messages to the mobile phone of the User.</p>
            <p class="pb"><span class="pn">4.2</span> The collection of information provided by User is carried out by automated use the software tools of the Site to indicate the relevant data required to publish posts on the Site.</p>
            <p class="pb"><span class="pn">4.3</span> Information of a technical nature contained in the system, e.g. ip addresses, is used by the Company for purposes related to the maintenance of network equipment and for aggregation of general statistical, demographic information (e.g. about the region from which the User has made the connection) in accordance with the general rules of Internet messages.</p>
            <p class="pb"><span class="pn">4.4</span> The Company stores the data of the User's last access to the system in order to ensure high quality of the services provided, which are adapted to the individual needs and interests of the User.</p>
            <p class="pb"><span class="pn">4.5</span> The User accesses the services of the Site during the time periods of continuous use - sessions. The registered User shall access the part of the Site accessible only after entering the login and password at least once during the session.</p>
            <p class="pb"><span class="pn">4.6</span> Disabling the saving of data of the last access to the system in browser settings does not affect the possibility of using the services of the Site as a whole, but may limit their functionality for the User.</p>
            <p class="pb"><span class="pn">4.7</span> Data from the last access to the system are also used to collect statistical information on the use of the services by the Users.</p>
            <p class="pb"><span class="pn">4.8</span> The User is prohibited from providing information in violation of this Agreement or the rights of third parties, in particular, the information must not contain:</p>
            <ul class="pbl">
                <li>vulgar, offensive expressions;</li>
                <li>advocacy of hatred, violence, discrimination, racism, xenophobia and ethnic conflicts;</li>
                <li>calls for violence and unlawful actions;</li>
                <li>data that violate the personal (non-property) rights or intellectual property rights of third parties;</li>
                <li>information that encourages fraud, deception or breach of trust;</li>
                <li>information that leads to transactions with stolen or counterfeit items;</li>
                <li>information that violates or infringes on third party property, trade secrets or the right to privacy;</li>
                <li>personal or identifying information about other persons without their express consent;</li>
                <li>information containing information that infringes on privacy, offends someone's honour, dignity or business reputation;</li>
                <li>information containing libel or threats against anyone;</li>
                <li>information that is pornographic in nature;</li>
                <li>information that is harmful to minors;</li>
                <li>false and misleading information;</li>
                <li>viruses or any other technology that could harm the sites, the Company or other Users;</li>
                <li>information about services considered immoral, such as: prostitution or other forms contrary to morality or the law;</li>
                <li>links or information about sites that compete with the Company's services;</li>
                <li>information that constitutes "spam", "chain letters", "pyramid schemes" or unwanted or false commercial advertising;</li>
                <li>information distributed by information agencies;</li>
                <li>information with an offer to earn money on the Internet, without providing a physical address or direct contacts of the employer;</li>
                <li>information offering franchise, multi-level and network marketing, agency, trade mission or any other activity that requires the recruitment of other members, sub-agents, sub-distributors, etc.;</li>
                <li>information solely of an advertising nature without offering a particular product or service;</li>
                <li>information that otherwise violates the laws of the country for which the post is intended.</li>
            </ul>
            <p class="pb"><span class="pn">4.9</span> When submitting an post with offers of services subject to licensing, the text of the post must include the licence number and the name of the issuing authority.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">5</span> REASONS FOR DELETION OF POSTS</h2>
            <p class="pb"><span class="pn">5.1</span> An user post may be removed by the Company due to the User's breach of the terms and conditions of this Agreement, as well as for the following reasons:</p>
            <ul class="pbl">
                <li>The given User already has on the Site the active similar post with advertising of this product/service;</li>
                <li>The information contained in the post is in conflict with this Agreement, the rules of publishing posts and/or legislation;</li>
                <li>The information contained in the post is false;</li>
                <li>The title of the post does not contain information about the product/service offered/sold;</li>
                <li>The title or comment on the photo contains a link to Internet resources;</li>
                <li>the photo does not have an obvious semantic connection with the text of the post or does not serve the purpose of adequately illustrating the text of the post;</li>
                <li>The photo contains user interface elements, abstract drawings, etc.;</li>
                <li>The photo contains any advertising information (link to the website, e-mail, telephone number (other than the one indicated in the post), Skype, ICQ, social network ID, ID of other messengers, etc.);</li>
                <li>A photograph of poor quality, the subject depicted is indistinguishable;</li>
                <li>The post is submitted under a heading that does not correspond to the meaning of the submitted post.</li>
                <li>The Company has been provided with a complaint from the owner of intellectual property rights and/or a request from the authorised state authority;</li>
                <li>The Company has received a justified complaint from another User about the violation of their rights in the post.</li>
            </ul>
        </div>
        <div>
            <h2 class="ph"><span class="pn">6</span> RIGHTS AND OBLIGATIONS OF THE PARTIES</h2>
            <p class="pb"><span class="pn">6.1</span> All objects available through the Company's services, including design elements, text, graphic images, illustrations, video, computer programs, databases, music, sounds and other objects, as well as any content placed on the services of the Websites, are subject to the exclusive rights of the Company, Users and other rights holders.</p>
            <p class="pb"><span class="pn">6.2</span> The use of content, as well as any other elements of the services, is possible only within the framework of the functionality offered by one or another service on the Sites. No elements of the content of the Websites' services, as well as any content placed on the Websites' services, may be used in any other way without prior permission of the rights holder. Use means, inter alia, but not exclusively: reproduction, copying, processing, distribution on any basis, etc.</p>
            <p class="pb"><span class="pn">6.3</span> In order to grant the Company the right to publish the information provided by the User, the User grants the Company a universally valid (territorially unlimited), perpetual, irrevocable, non-exclusive, sub-licensable right to use, publish, collect, display, copy, duplicate, reproduce, make available to the public the copyrights, publications and databases held by the User, as well as the information, images and photographs provided by the User on all pages of the website. The above rights are granted to the Company free of charge (without remuneration). In doing so, the User retains all property rights to the content of the information published in the post. In addition to the above, the User grants the right to access the information posted by them to all users of the Sites. The User agrees that the text, photos, and other materials added to the post can be used by the Company in the preparation of advertising materials, articles, reports, analyses, etc., and used by the Company at its own discretion without additional consent of the User, without payment of remuneration.</p>
            <p class="pb"><span class="pn">6.4</span> By using the services of the Sites, the User confirms that they are solely responsible for the content of the posts published by them, and also possesses all necessary rights, licenses, permissions to publish information in the posts on the Sites, including without limitation all patents, trademarks, trade secrets, copyrights, or has the appropriate written consent, license or permission of all persons and companies identified in the post to use their names or images.</p>
            <p class="pb"><span class="pn">6.5</span> The user undertakes:</p>
            <ul class="pbl">
                <li>Not to take any actions that may result in a disproportionate load on the infrastructure of the Sites;</li>
                <li>Not to use automatic programs to access the Sites without written permission of the Company;</li>
                <li>Not to copy, reproduce, change, distribute or present to the public any information contained on the Sites (except for information provided by the User) without prior written permission of the Company;</li>
                <li>Not to interfere or try to interfere with the work and other activities on the Sites; and not to interfere with automatic systems or processes, as well as other activities in order to prevent or limit access to the Sites;</li>
                <li>Not to use the information provided by other Users for purposes other than to make a transaction directly with this User, without the written permission of another User. This clause of the Agreement does not include the personal data of the User which the latter provides to the Company upon registration.</li>
            </ul>
            <p class="pb"><span class="pn">6.6</span> The User is prohibited:</p>
            <ul class="pbl">
                <li>Discussion of the actions of the moderators and the Site administration in any other way than by means of electronic correspondence with the moderators;</li>
                <li>Using the Users' names similar to those of other Users in order to impersonate them and write messages on their behalf.</li>
                <li>Use in the text of the post, in photos statuses that are not provided by the Company (e.g. "best seller", "recommended", "verified", etc.).</li>
                <li>To use the "rigmanager" sign for goods and services in the text of the post, in photos, in any of its manifestations, symbols similar to the sign for goods and services, and any other derivatives.</li>
            </ul>
            <p class="pb"><span class="pn">6.7</span> Access to the User's personal data by other Users is only possible with the User's written consent to such access or in compliance with the requirements of the relevant legislation.</p>
            <p class="pb"><span class="pn">6.8</span> The Company undertakes to make every effort to properly perform its duties under this Agreement, including normal operation of the Websites' services and nonproliferation to third parties of the personal data provided by the User, except in cases stipulated by law.</p>
            <p class="pb"><span class="pn">6.9</span> The Company may from time to time establish restrictions on the use of the Sites' services, in particular, the maximum number of days of storage of posts and their size. The Company has the right at any time to change or terminate the services of the Sites or their part with or without notice to the User, without being responsible for such changes or termination.</p>
            <p class="pb"><span class="pn">6.10</span> To maintain the high quality of its services, the Company reserves the right to limit the number of active posts of the User on the Websites, as well as to limit the User's actions on the Websites.</p>
            <p class="pb"><span class="pn">6.11</span> The Company can prohibit the User from accessing the Sites if the User violates the terms of this Agreement. The fact of violation is considered confirmed if the User has been notified by the Administration of the Sites about activities that violate the rules of the Sites and the rights of third parties. The Company reserves the right to delete or disable the User's account at any time, as well as to delete all posted posts of the User, leaving a preliminary notice of such disabling at the User's discretion, and not being responsible for its actions to the User and third parties.</p>
            <p class="pb"><span class="pn">6.12</span> The Company has the right at its own discretion to reject, delete or move any post posted on the Sites for violation of this Agreement.</p>
            <p class="pb"><span class="pn">6.13</span> The Company has the right to transfer the Sites with all its services and content, including personal information of Users, to its successor under contracts or other reasons. The transfer and notification of Users about such transfer is carried out in accordance with the requirements of the current legislation of Ukraine.</p>
            <p class="pb"><span class="pn">6.14</span> The User has the right to send complaints about the operation of the Website through the <a class="body-link" href="{{loc_url(route('contacts'))}}">Feedback</a> function, which will be considered within two working days from the moment of their receipt or from the moment of receiving complete information about the essence of the complaint. The Company has the right, at its own discretion, to terminate consideration of the complaint and/or limit the number of responses to Users who violate the terms of the Agreement. The Operator providing support to the Users by phone and/or answering the phone call of the User has the right to stop the call in case of threats of the User to the Operator, the Company, obscene language, translation of the conversation on personal topics, non-objectivity of the conversation.</p>
            <p class="pb"><span class="pn">6.15</span> The Company reserves the right to demand from the User at any time to confirm the data specified by the User during the registration, failure to provide which, at the discretion of the User, can be equated to the provision of inaccurate information. If the data of the User specified in the confirmation provided by the User does not correspond to the data specified in the registration, as well as in the case when the data specified in the registration does not allow to identify the User, the Company has the right to deny the User access to use the services of the Sites with or without prior notification of the User.</p>
            <p class="pb"><span class="pn">6.16</span> EMAIL-verification. The Company has the right to verify the User at any time through EMAIL-verification. In case if the User has not passed verification, the Company has the right to limit possibilities of use of the Site, namely placing, editing, prolongation, updating of posts. Selection of Users which are subject to verification is at the Company's own discretion.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">7</span> PAYMENT OF SERVICES</h2>
            <p class="pb"><span class="pn">7.1</span> Ordering (acceptance) of paid rigmanager.com.ua services is carried out by the User on the service order page, in their personal account.</p>
            <p class="pb"><span class="pn">7.2</span> The User undertakes to read the prices for the Company's paid services posted on the Websites, after which they can order such services. The cost of the selected service is available on the order page and depends on the order parameters.</p>
            <p class="pb"><span class="pn">7.3</span> Payment for the Company's paid services is made according to the procedure indicated at the following address <a class="body-link" href="{{loc_url(route('plans'))}}">{{route('plans')}}.</p>
            <p class="pb"><span class="pn">7.4</span> The Company shall refund the money paid for the services not provided in the following cases:</p>
            <ul class="pbl">
                <li>If due to any technical malfunction the service has not been provided, the refund of the money paid for the service will be made by the Site administrator authorised by the Company after the user has provided proof of payment. In this case, the refund will be made to the bank card from which the respective service was paid for.</li>
                <li>When paying for services from remote/located by the Company accounts, which have been duplicated by the User in violation of the terms of this Agreement. Such refund will be made by the Company only upon the User's request and the refund will be made to the bank card from which the service was paid for. If a refund is not possible due to the expiry of the card or for other reasons, the funds are not refunded.</li>
            </ul>
            <p class="pb">If the account for placing posts for prohibited goods, services or offers is blocked, the funds are not returned.</p>
            <p class="pb">No refund will be made for services already provided by the Company.</p>
            <p class="pb"><span class="pn">7.5</span> In the event of systematic (two or more times) violations of the terms of this Agreement, the funds paid by the User shall not be refunded. In the case of account blocking due to the detection of the possibility that as a result of deliberate violations of the User Agreement by other users may/could have incurred losses, the money paid for services that were not received before such blocking is not refundable.</p>
            <p class="pb"><span class="pn">7.6</span> The user agrees that the confirmation of the provision of services by the Service Provider is a personal account statement, which is generated by the Service Provider on the basis of data available in the User's account. The Provider provides the Statement of personal account only upon request of Users.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">8</span> LIMITATION OF LIABILITY OF THE COMPANY</h2>
            <p class="pb"><span class="pn">8.1</span> By using the services of the Sites, the User confirms his consent to the fact that he uses the Sites and his services at his own risk "as is", assesses and bears all risks associated with the use of posts published on the Sites, and the Company, including its management, employees and agents, are not responsible for the content of posts published on the Site, for any losses and damages resulting from the use of posts published on the Site.</p>
            <p class="pb"><span class="pn">8.2</span> The Company is not the organizer/initiator of a transaction between Users or its party. The Site is a trading communication platform that enables Users to publish for sale, sell and purchase legally permitted goods and services at any time, from anywhere and at any price.</p>
            <p class="pb"><span class="pn">8.3</span> The Company cannot control the accuracy of information posted by Users in posts. The Company shall not be liable for any damage caused as a result of the transaction or improper behaviour of any party to the transaction.</p>
            <p class="pb"><span class="pn">8.4</span> The Company is not responsible for the behaviour of Users or for the goods/services offered by them in the posts published. All disputes and conflicts between Users shall be resolved by them independently without involving the Company.</p>
            <p class="pb"><span class="pn">8.5</span> The Company is not responsible for any unauthorised access or use of the Company's servers and/or any information about users stored on them, as well as for any errors, viruses, Trojan horses, etc., which may be transferred to or through the Sites by third parties.</p>
            <p class="pb"><span class="pn">8.6</span> The quality, safety, legality and compliance of a product or service with its description, as well as the User's ability to sell or purchase a product/service are beyond the Company's control.</p>
            <p class="pb"><span class="pn">8.7</span> The Company encourages Users to be careful and keep common sense when using the services of the Sites. The User must take into account that their counterparty may not have the appropriate legal capacity or impersonate another person. Use of the Company's services implies that the User understands and accepts these risks and also agrees that the Company is not responsible for actions or omissions on the part of the User.</p>
            <p class="pb"><span class="pn">8.8</span> The User cannot conclude that the offer, sale and purchase of any product or service is valid and legal based on the fact of placing, selling and purchasing a product or service on the Websites. The Company is not responsible for the completion of the transaction by the User on the Sites. The User assumes full responsibility for their actions.</p>
            <p class="pb"><span class="pn">8.9</span> If the User has claims to another User as a result of the latter's use of the Site's services, the User agrees to make these claims independently and without interference from the Company, and releases the Company (in the case of its subsidiaries) from all requirements of the obligations of compensation for damages to losses of costs and expenses, including attorneys' fees known or unknown arising as a result of or in connection with the sale of goods or services on the Sites.</p>
            <p class="pb"><span class="pn">8.10</span> Inaction on the part of the Company in the event of a violation of the provisions of the Agreement by a User or other Users does not deprive the Company of its right to take appropriate actions to protect its interests at a later date, and does not mean that the Company relinquishes its rights in the event of such violations in the future.</p>
            <p class="pb"><span class="pn">8.11</span> The User has the right to inform the Company of the fact of violation of their rights by another User using the <a class="body-link" href="{{loc_url(route('contacts'))}}">Feedback</a> function. If the complaints of the User are justified, the Company at its discretion will remove the post that violates the rights of the User.</p>
            <p class="pb"><span class="pn">8.12</span> The Company shall not be liable for non-performance or difficulties in performance of obligations to provide access to the Sites due to unforeseen force majeure circumstances, consequences of which cannot be avoided or overcome (such as decisions of the authorities, labor disputes, accidents, breaks in the general communication system, etc.).</p>
            <p class="pb"><span class="pn">8.13</span> The Company shall not be liable for any malfunctions in the operation of the Sites caused by technical failures in the equipment and software.</p>
            <p class="pb"><span class="pn">8.14</span> In no event shall the Company, its management, employees and agents be liable for direct, indirect, incidental, special damages, losses and penalties of any nature (even if the Company has been advised of the possibility of such damages) as a result of the User's use of the Websites and its services, including, without limitation, cases in which the damages resulted from the use or misuse of the Websites and its services.</p>
            <p class="pb"><span class="pn">8.15</span> Nothing in the Agreement may be understood as establishment of agency, partnership, joint activity, labor relations between the User and the Company, or any other relations, not expressly stipulated by the Agreement.</p>
            <p class="pb"><span class="pn">8.16</span> The Company is responsible for posts published on the Websites' services to the extent provided by the applicable law.</p>
            <p class="pb"><span class="pn">8.17</span> The Company shall not be responsible for safety of information from the account, possibility to use the Website services, safety and possibility to use funds on the User's personal account, in case of blocking/banning the use of third-party services, by means of which the User registers and/or enters the Website, which are beyond the Company's control.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">9</span> VALIDITY PERIOD OF THE AGREEMENT AND TERMINATION OF PROVISION OF THE WEBSITE SERVICES</h2>
            <p class="pb"><span class="pn">9.1</span> This Agreement shall enter into force from the moment when the User starts using any service of the Website, from the moment of registration of the User on the Website and shall be valid for an indefinite period of time.</p>
            <p class="pb"><span class="pn">9.2</span> The User shall be entitled to terminate its registration on the Website unilaterally, without prior notification of the Company and explanation of reasons.</p>
            <p class="pb"><span class="pn">9.3</span> If the Company has made any changes to the Agreement in the procedure stipulated by clause 10.1 of the Agreement, with which the User disagrees, it shall stop using the Website services. The fact of non-stop use of the Websites shall be the confirmation of consent of the User to the corresponding edition of the Agreement.</p>
            <p class="pb"><span class="pn">9.4</span> Termination of the Agreement by the Company may occur in cases:</p>
            <p class="pb psb"><span class="pn">9.4.1</span> Violation of the provisions of this Agreement, infliction of any damage to the Company, including its reputation, or to the users of rigmanager.com.ua;</p>
            <p class="pb psb"><span class="pn">9.4.2</span> Performing other actions that are contrary to the Company's policy;</p>
            <p class="pb"><span class="pn">9.5</span> Legal relations may be resumed only after the Company's administration has made a decision.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">10</span> MAKING CHANGES TO THE AGREEMENT</h2>
            <p class="pb"><span class="pn">10.1</span> In order to improve the quality of services provided on the Websites, to comply with the requirements of legislation and to respond to changes in market conditions, this Agreement may be unilaterally amended by the Company. The new version of the Agreement comes into force from the moment of its publishing on the Internet at the address specified in this paragraph of the Agreement, unless otherwise provided by the new version of the Agreement. The current version of the Agreement is always on the page at the address <a class="body-link" href="{{loc_url(route('terms'))}}">{{route('terms')}}</a>.</p>
        </div>
        <div>
            <h2 class="ph"><span class="pn">11</span> OTHER CONDITIONS</h2>
            <p class="pb"><span class="pn">11.1</span> System messages of the Websites related to the User's posts shall be delivered to the e-mail address provided by the User when placing an post on the Websites. In case of the User's unwillingness to receive such messages, the User shall be entitled to delete the corresponding posts from the Websites, or send the corresponding message to the Website Support Service.</p>
            <p class="pb"><span class="pn">11.2</span> Information messages, intended for a wide range of Users, shall be published at the Websites and/or sent to e-mail addresses of the Users, who confirmed their consent to receive such messages during publication of posts/registration at the Website.</p>
            <p class="pb"><span class="pn">11.3</span> The Users shall be entitled to refuse to receive information messages to their e-mail address specified by the User, at any time through the "Unsubscribe from mailing" function contained in the User's account.</p>
            <p class="pb"><span class="pn">11.4</span> In case of any disputes and disagreements between the Parties under this Agreement or in connection therewith, the Parties shall resolve them through negotiations. If any disputes, controversies or claims arising from or in connection with this Agreement, including those related to its execution, violation, termination or invalidity, can not be resolved through negotiations, these disputes shall be considered in accordance with the current legislation in court.</p>
            <p class="pb"><span class="pn">11.5</span> This Agreement shall be governed by and interpreted in accordance with the laws of Ukraine. The issues not regulated by this Agreement shall be resolved in accordance with the current legislation of Ukraine. All possible disputes arising from the relations regulated by this Agreement shall be settled in the order established by the legislation of Ukraine, according to the norms of Ukrainian law.</p>
            <p class="pb"><span class="pn">11.6</span> Everywhere under the text of this Agreement, unless expressly stated otherwise, the term "applicable law" shall mean both the legislation of Ukraine and the legislation of the place of User's/Users' residence.</p>
            <p class="pb"><span class="pn">11.7</span> Court recognition of any provision of this Agreement as invalid or unenforceable shall not entail invalidity or unenforceability of other provisions of this Agreement. Translated with www.DeepL.com/Translator (free version)</p>
        </div>
    </article>
@endsection

@section('scripts')

@endsection