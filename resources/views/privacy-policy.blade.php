@extends('layouts.app')

@section('title', 'Privacy Policy Dumask.id')
    
@section('content')

<div class="container w-md-75 my-4">
    <div class="card rounded border-0 shadow px-4 py-2 mx-3 my-2" style="border-radius: 0.5rem">
        <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">
            Privacy Policy for Dumask.id
        </h2>
        <hr class="my-2">
        <div class="text-secondary text-justify mt-4 mx-auto">
            <h5 class="mx-md-4 mt-3" style="line-height: 175%">
                At Dumask.id, accessible from <a href="https://dumask.id/">https://dumask.id/</a>, 
                one of our main priorities is the privacy of our visitors. This Privacy Policy document 
                contains types of information that is collected and recorded by Dumask.id and how we use it.
                If you have additional questions or require more information about our Privacy Policy, 
                do not hesitate to contact us.
            </h5>
            <h4 class="font-weight-bold mt-3">
                Log Files
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Dumask.id follows a standard procedure of using log files. These files log visitors when 
                they visit websites. All hosting companies do this and a part of hosting services' analytics. 
                The information collected by log files include internet protocol (IP) addresses, browser type, 
                Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the 
                number of clicks. These are not linked to any information that is personally identifiable. 
                The purpose of the information is for analyzing trends, administering the site, tracking users' 
                movement on the website, and gathering demographic information.
            </h5>
            <h4 class="font-weight-bold mt-3">
                Cookies and Web Beacons
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Like any other website, Dumask.id uses 'cookies'. These cookies are used to store information 
                including visitors' preferences, and the pages on the website that the visitor accessed or visited. 
                The information is used to optimize the users' experience by customizing our web page content based 
                on visitors' browser type and/or other information. For more general information on cookies, please read 
                <a href="https://www.privacypolicyonline.com/what-are-cookies">"What Are Cookies" from Cookie Consent.</a>
            </h5>
            <h4 class="font-weight-bold mt-3">
                Google DoubleClick DART Cookie
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, 
                to serve ads to our site visitors based upon their visit to www.website.com and other sites on 
                the internet. However, visitors may choose to decline the use of DART cookies by visiting the 
                Google ad and content network Privacy Policy at the following URL – <br>
                <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a>
            </h5>
            <h4 class="font-weight-bold mt-3">
                Our Advertising Partners
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Some of advertisers on our site may use cookies and web beacons. Our advertising partners are 
                listed below. Each of our advertising partners has their own Privacy Policy for their policies 
                on user data. For easier access, we hyperlinked to their Privacy Policies below.
                <ul>
                    <li>
                        Google <br>
                        <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a>
                    </li>
                </ul>
            </h5>
            <h4 class="font-weight-bold mt-3">
                Privacy Policies
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                You may consult this list to find the Privacy Policy for each of the advertising 
                partners of Dumask.id. Third-party ad servers or ad networks uses technologies 
                like cookies, JavaScript, or Web Beacons that are used in their respective 
                advertisements and links that appear on Dumask.id, which are sent directly to 
                users' browser. They automatically receive your IP address when this occurs. These 
                technologies are used to measure the effectiveness of their advertising campaigns 
                and/or to personalize the advertising content that you see on websites that you visit. 
                Note that Dumask.id has no access to or control over these cookies that are
                 used by third-party advertisers.
            </h5>
            <h4 class="font-weight-bold mt-3">
                Third Party Privacy Policies
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Dumask.id's Privacy Policy does not apply to other advertisers or websites. 
                Thus, we are advising you to consult the respective Privacy Policies of these 
                third-party ad servers for more detailed information. It may include their practices 
                and instructions about how to opt-out of certain options. You can choose to disable 
                cookies through your individual browser options. To know more detailed information about 
                cookie management with specific web browsers, it can be found at the browsers' respective websites. 
                <a href="https://www.privacypolicyonline.com/what-are-cookies">What Are Cookies?</a>
            </h5>
            <h4 class="font-weight-bold mt-3">
                Children's Information
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                Another part of our priority is adding protection for children while using the internet. 
                We encourage parents and guardians to observe, participate in, and/or monitor and guide 
                their online activity. Dumask.id does not knowingly collect any Personal Identifiable 
                Information from children under the age of 13. If you think that your child provided 
                this kind of information on our website, we strongly encourage you to contact us 
                immediately and we will do our best efforts to promptly remove such information from 
                our records.
            </h5>
            <h4 class="font-weight-bold mt-3">
                Online Privacy Policy Only
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                This Privacy Policy applies only to our online activities and is valid for visitors 
                to our website with regards to the information that they shared and/or collect in Dumask.id. 
                This policy is not applicable to any information collected offline or via channels other than 
                this website.
            </h5>
            <h4 class="font-weight-bold mt-3">
                Consent
            </h4>
            <h5 class="mx-md-4" style="line-height: 175%">
                By using our website, you hereby consent to our Privacy Policy and agree to its 
                <a href="{{ route('terms') }}">Terms and Conditions.</a>
            </h5>
        </div>
    </div>    
</div>

@endsection
