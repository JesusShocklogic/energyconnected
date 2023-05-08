<?php
/*
 * Template name: Programme 2 (DEPRECATED)
 * Description: Programme 2 sort by start time. Sessions have the same start time and the same end time.
 */
get_header();
$speakers_modal = get_field('speakers_modal');
$show_job_title = $speakers_modal['show_job_title'] ? "block" : "none";
$show_company_name = $speakers_modal['show_company_name'] ? "block" : "none";

$speaker_name_colour = $speakers_modal['speaker_name_colour'] ?? "#000";
$job_title_colour = $speakers_modal['job_title_colour'] ?? "#000";
$company_name_colour = $speakers_modal['company_name_colour'] ?? "#000";

$captions = $speakers_modal['captions_group']; ?>
<style>
    .modal_body_left {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .modal_dialog_content_footer_session_day_name,
    .modal_dialog_content_footer_session_rol,
    .modal_dialog_content_footer_session_time,
    .modal_dialog_content_footer_session_title {
        display: inline-block;
    }

    .modal_dialog_content_footer_session_title {
        font-weight: 700;
    }

    .modal_dialog_content_footer_session_presentations_title {
        font-weight: 700;
    }

    .modal_dialog_content_footer_session {
        padding-bottom: 1rem;
    }

    .width-speakers {
        width: 30%;
    }

    .modal_dialog_content_body_left_name {
        color:
            <?= $speaker_name_colour ?>
        ;
    }

    .modal_dialog_content_body_left_jobtitle {
        display:
            <?= $show_job_title ?>
        ;
        color:
            <?= $job_title_colour ?>
        ;
    }

    .modal_dialog_content_body_left_companyname {
        display:
            <?= $show_company_name ?>
        ;
        color:
            <?= $company_name_colour ?>
        ;
    }


    @media (min-width: 1200px) {
        .modal-body {
            display: grid;
            grid-template-columns: 1fr 2fr;
            align-content: center;
            justify-content: center;
            align-items: start;
            grid-gap: 20px;
        }

        .modal_body_left {
            text-align: center;
        }

        .modal_body_left_img {
            width: 70% !important;
            margin: 0 auto !important;
            margin-bottom: 1rem !important;
        }
    }
</style>
<?php
$programme_group = get_field('programme_group');

$chairs = $programme_group['chairs'] ?? "Chair(s)";
$session_time = $programme_group['session_time'] ?? "Session time";
$presentation_time = $programme_group['presentation_time'] ?? "Pres Time";
$presentation_title = $programme_group['presentation_title'] ?? "Presentation title";
$speakerauthors = $programme_group['speakerauthors'] ?? "Speaker/Authors";

function getCurrentDate2($timezone, $format, $additionalMinutes = 0)
{

    date_default_timezone_set($timezone);

    if ($format == "Y-m-d") {
        $currentDate = date('Y-m-d');
    } else if ($format == "Y-m-d H:i") {
        // ADD N° MINUTES TO DATE 
        $currentDate = date('Y-m-d H:i', (time() + 60 * $additionalMinutes));
    } else {
        $currentDate = date();
    }

    return $currentDate;
}

function convertDate2($string)
{

    $date = date("Y-m-d H:i", strtotime($string));
    return $date;
}

if (have_posts()) {
    while (have_posts()) {
        the_post();
        $data = get_field('data');
        $timezone = get_field('timezone', 'option');
        $showPresentationsTables = 1;
        $showPresentationsSpeakersModal = 1;
        $filter_by_session_type_select = 0;
        $DayTab = isset($_GET['DayTab']) ? $_GET['DayTab'] : null;
        ?>
        <style>
            .programme {
                padding-bottom: 2rem;
            }

            .session-title {
                font-weight: bold;
                color:
                    <?= $programme_group['title_colour'] ?? "black"; ?>
                ;
                text-align:
                    <?= $programme_group['title_alignment'] ?? "left"; ?>
                ;
            }

            .presentations {
                display:
                    <?php if ($programme_group['showhide_presentation_table'] == "show")
                        echo "block";
                    else
                        echo "none"; ?>
                ;
            }

            .presentations table {
                margin-top: 5px;
            }

            .presentations thead {
                display:
                    <?php if ($programme_group['presentation_group']['presentations_table_header'] == "show")
                        echo "table-header-group";
                    else
                        echo "none"; ?>
                ;
            }

            .presentations .presentation_time,
            .presentations .thead_presentation_time {
                display:
                    <?php if ($programme_group['presentation_group']['presentation_time_column'] == "show")
                        echo "block";
                    else
                        echo "none"; ?>
                ;
            }

            .session_time {
                display:
                    <?php if ($programme_group['showhide_session_time'] == "show")
                        echo "block";
                    else
                        echo "none"; ?>
            }
        </style>
        <?php

        /*
         * Functions
         */

        /*
         * Programme Builder
         */
        // Day tabs
        // filter_by_session_type_select = 0 No filter
        // filter_by_session_type_select = 1 Filter by one session type
        $days = get_programme_days();

        $programmeTabs = <<<TABS
            <div class="list-group list-group-horizontal text-center" id="list-tab" role="tablist">
TABS;

        $firstDay = array_key_first($days);
        $lastDay = array_key_last($days);

        foreach ($days as $key => $day) {
            $title = $day->session_day_name;

            if (isset($DayTab) && $DayTab == $key) {
                $programmeTabs .= <<<TABS
                <a class="list-group-item list-group-item-action active" id="list-$key-list" data-bs-toggle="list" href="#list-$key" role="tab" aria-controls="$key">$title</a>
TABS;
            } elseif (isset($DayTab) && $DayTab != $key) {
                $programmeTabs .= <<<TABS
                <a class="list-group-item list-group-item-action" id="list-$key-list" data-bs-toggle="list" href="#list-$key" role="tab" aria-controls="$key">$title</a>
TABS;
            }
            //if this is the first interaction and (our current day is before the start of the event or our current day is after the days of the event)
            elseif ($key == 0 && (getCurrentDate2($timezone, 'Y-m-d') < $days[$firstDay]->session_day || getCurrentDate2($timezone, 'Y-m-d') > $days[$lastDay]->session_day)) {
                $programmeTabs .= <<<TABS
                <a class="list-group-item list-group-item-action active" id="list-$key-list" data-bs-toggle="list" href="#list-$key" role="tab" aria-controls="$key">$title</a>
TABS;
            } elseif (getCurrentDate2($timezone, 'Y-m-d') == $day->session_day) {
                $programmeTabs .= <<<TABS
                    <a class="list-group-item list-group-item-action active" id="list-$key-list" data-bs-toggle="list" href="#list-$key" role="tab" aria-controls="$key">$title</a>
TABS;
            } else {
                $programmeTabs .= <<<TABS
                    <a class="list-group-item list-group-item-action" id="list-$key-list" data-bs-toggle="list" href="#list-$key" role="tab" aria-controls="$key">$title</a>
TABS;
            }
        } //foreach
        $programmeTabs .= <<<TABS
            </div>
TABS;

        // Programme Content
        $fullProgramme = '<div class="tab-content pt-4 bg-white" id="nav-tabContent">';
        // GETTING THE DAYS
        foreach ($days as $key => $day) {
            $dayContent = "";
            if (isset($DayTab) && $DayTab == $key) {
                $dayContent .= <<<CONTENT
                    <div class="tab-pane fade show active" id="list-$key" role="tabpanel" aria-labelledby="list-$key-list">
                        <div class="row">
CONTENT;
            } elseif (isset($DayTab) && $DayTab != $key) {
                $dayContent .= <<<CONTENT
                    <div class="tab-pane fade" id="list-$key" role="tabpanel" aria-labelledby="list-$key-list">
                        <div class="row">
CONTENT;
            }
            //if this is the first interaction and (our current day is before the start of the event or our current day is after the days of the event)
            elseif ($key == 0 && (getCurrentDate2($timezone, 'Y-m-d') < $days[$firstDay]->session_day || getCurrentDate2($timezone, 'Y-m-d') > $days[$lastDay]->session_day)) {
                $dayContent .= <<<CONTENT
                    <div class="tab-pane fade show active" id="list-$key" role="tabpanel" aria-labelledby="list-$key-list">
                        <div class="row">
CONTENT;
            } elseif (getCurrentDate2($timezone, 'Y-m-d') == $day->session_day) {
                $dayContent .= <<<CONTENT
                    <div class="tab-pane fade show active" id="list-$key" role="tabpanel" aria-labelledby="list-$key-list">
                        <div class="row">
CONTENT;
            } else {
                $dayContent .= <<<CONTENT
                    <div class="tab-pane fade" id="list-$key" role="tabpanel" aria-labelledby="list-$key-list">
                        <div class="row">
CONTENT;
            }

            //GETTING THE START TIMES
            // filter_by_session_type_select = 0 No filter
            // filter_by_session_type_select = 1 Filter by one session type
            if ($filter_by_session_type_select == 0) {
                $startTimes = get_sessions_startTime_by_day($day);
            } elseif ($filter_by_session_type_select == 1) {
                $startTimes = get_sessions_startTime_by_day_and_sessionType($day, $data['session_type']);
            }

            $timeContent = "";
            foreach ($startTimes as $key2 => $startTime) {

                //GETTING THE SESISONS
                $time = $startTime->start_time;
                //$sessions = get_sessions_by_date_by_startTime($day, $time);
                $sessions = get_sessions_by_date_by_startTime_orderBy_room($day, $time);
                $sessionsContent = "";

                foreach ($sessions as $key3 => $session) {

                    $speakers = get_all_speakers_by_session($session);
                    $speakersContent = "";

                    /*
                     * Chair Speakers Builder
                     */
                    if (!empty($speakers)) {
                        $speakersContent = "<div><strong>$chairs: </strong>";
                        foreach ($speakers as $key4 => $speaker) {
                            $id = $speaker->speaker_id;
                            $name = $speaker->speaker_name;
                            $lastName = $speaker->speaker_family_name;

                            if ($key4 == 0) {
                                $speakersContent .= <<<NAME
                                    <a id="speaker" class="text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#speaker-$id">
                                        $name $lastName
                                    </a>
NAME;
                            } else {
                                $speakersContent .= <<<NAME
                                    <a id="speaker" class="text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#speaker-$id">
                                        , $name $lastName
                                    </a>
NAME;
                            }
                        } //foreach Speakers
                        $speakersContent .= "</div>";
                    } // Speakers is not empty

                    /*
                     * Presentations Builder
                     */
                    $tableContent = "";
                    // If presentations table is enable in the Dashboard.
                    if ($showPresentationsTables == 1) {
                        $presentations = get_presentations_from_session($session);
                        $presentationsContent = "";

                        if (!empty($presentations)) {
                            foreach ($presentations as $key4 => $presentation) {
                                $presentationTime = substr($presentation->start_time, 0, -3);
                                ;
                                $presentationTitle = $presentation->presentation_title;
                                $presentationBody = $presentation->presentation_body ?? "";
                                $allSpeakersContent = $presentation->all_speakers;
                                $presentationId = $presentation->presentation_id;
                                //getting information for the authors
                                $authors = "";
                                if ($showPresentationsSpeakersModal == 1) {
                                    if (!empty($allSpeakersContent)) {
                                        $allSpeakersContent = json_decode($allSpeakersContent);
                                        $authors .= "<td class='width-speakers'>";
                                        foreach ($allSpeakersContent as $key5 => $SpeakerContent) {
                                            $id = $SpeakerContent->Faculty_Id;
                                            $fullName = $SpeakerContent->Full_Name;
                                            if ($key5 == 0) {
                                                $authors .= <<<AUTHOR
                                                    <a id="speaker" class="text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#speaker-$id">
                                                        $fullName
                                                    </a>
AUTHOR;
                                            } else {
                                                $authors .= <<<AUTHOR
                                                    <a id="speaker" class="text-decoration-underline" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#speaker-$id">
                                                        , $fullName
                                                    </a>
AUTHOR;
                                            }
                                        } // Foreach authors in the presentations
                                        $authors .= "</td>";
                                    } // IF No speakers in the presentation
                                } // IF presentations_speakers_modals is enabled in the Dashboard
                                else {
                                    $authors = "<td>" . str_replace('"', '', $presentation->all_speakers_list) . "</td>";
                                }

                                $moreInfo = "";
                                /*
                                if (!empty(json_decode($allSpeakersContent)) || !empty(trim($presentationBody))) {
                                $moreInfo = "(<a href='/COMUNICACIONYSALUD/presentation-info/?presentation_id=$presentationId&DayTab=$key'><i>Más información</i></a>)";
                                }
                                */

                                $presentationsContent .= <<<CONTENT
									<tr>
										<th scope="row" class="presentation_time">$presentationTime</th>
										<td>
											<div class="presentation_title">$presentationTitle $moreInfo</div>
											<div class="presentation_body">$presentationBody</div>
											<div class="presentation_authors">$authors</div>
										</td>
									</tr>
									CONTENT;
                            }

                            $tableContent .= <<<CONTENT
                                <!-- Table content -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap thead_presentation_time" scope="col">$presentation_time</th>
                                            <th scope="col">$presentation_title</th>
                                            <th scope="col">$speakerauthors</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        $presentationsContent
                                    </tbody>
                                </table>
CONTENT;
                        } // if presentations is not empty
                    } // If Presentation table is enable in the Dashboard

                    /*** End of presentations builder */

                    /*
                     * Session builder
                     */

                    $title = strip_tags($session->session_title, '<br>');
                    $titleImg = "";
                    if (preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $session->session_title, $titleImgSrcArray) == 1) {

                        //$titleImg = <<<IMG <div><img src="$titleImgSrc"></div> IMG;
                        $titleImgSrc = $titleImgSrcArray[0];
                        $titleImg = <<<IMG
                            <div class="mw-50">$titleImgSrc</div>
IMG;
                    }

                    // IF the session has a Room
                    if (!empty($session->room_name)) {
                        $room = "<div><strong>Location: </strong>$session->room_name</div>";
                    } else {
                        $room = "";
                    }

                    // IF the session has a Session type
                    if (!empty($session->session_type)) {
                        $sessionType = "<div><strong>Session type: </strong>$session->session_type</div>";
                    } else {
                        $sessionType = "";
                    }

                    $sessionHTML = $session->session_html;
                    $sessionTime = $session->start_time . " - " . $session->end_time;
                    $speakerIsConnect = "";

                    //get Session Id of the speaker
                    if ($_GET) {
                        if (!empty($_GET['SessionId'])) {
                            if ($session->session_id == $_GET['SessionId']) {
                                $speakerIsConnect = "scroll-to-speaker";
                            }
                        }
                    }

                    $sessionsContent .= <<<CONTENT
                            <!-- Sessions Info -->
                            <div class="col-12 col-lg px-5 px-lg-2 session $speakerIsConnect">
                                <div>
                                    <h5 class="session-title">$title </h5>
                                    $titleImg
									$sessionHTML
                                    
                                    $room
                                    $speakersContent
                                    $sessionType
                                    <div class="session_time"><strong>$session_time: </strong>$sessionTime</div>
                                </div>
                                <div class="presentations">$tableContent</div>
                            </div>
CONTENT;

                    if (($key3 + 1) % 3 == 0) {
                        $sessionsContent .= <<<CONTENT
                            <div class="w-100"></div>
CONTENT;
                    }

                    $lastSessionEndTime = $session->end_time;
                } //foreach sessions

                $timeContent .= <<<CONTENT
                    <!-- Sessions Times -->
                    <div class="container-fluid row">
                        <div class="col-12 col-lg px-5 d-flex justify-content-center align-items-center" style="border-right: 2px solid #ededed;border-bottom: 2px solid #ededed;">
                            <strong>
                                <h5>$time - $lastSessionEndTime</h5>
                            </strong>
                        </div>
                        <!-- Session Content -->
                        <div class="col-12 col-lg-10">
                            <div class="row">
                                $sessionsContent
                            </div>
                        </div>
                    </div>
CONTENT;
            } //foreach start time


            $dayContent .= <<<CONTENT
                            $timeContent
                        </div>
                    </div>
CONTENT;

            $fullProgramme .= $dayContent;
        } //foreach days
        $fullProgramme .= '</div>';
        ?>
        <style>
            /*.row {
                        width: 100%;
                    }*/

            .programme {
                font-size: 16px;
            }

            .programme h4,
            .programme .h4 {
                font-size: 16px;
            }

            .list-group-item {
                font-size: 16px !important;
                padding: 0.5rem 1.25rem;
            }

            .list-group-item.active {
                color: #F8F8F9;
                background-color: #186C9D;
                border-color: #186C9D;
            }

            .list-group {
                font-weight: bold;
            }

            .session {
                border-bottom: 2px solid #ededed;
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }

            table thead tr {
                height: 32px;
            }

            .table th,
            .table td {
                padding: 0.5rem;
            }

            table tbody tr:first-child {
                background-color: unset !important;
                color: #000000;
            }
        </style>

        <div class="programme standard_padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <?= $programmeTabs; ?>
                    </div>
                    <div class="col-12">
                        <?= $fullProgramme; ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 pb-4">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    wp_reset_postdata();
} else {
    echo "No content was found";
}
get_footer(); ?>

<script>
    var speakerScroll = $(".scroll-to-speaker").offset();

    if (speakerScroll !== undefined) {
        scroll(0, speakerScroll.top);
    }
</script>

<script>
    var elements = document.getElementsByClassName("btn-favorites");
    var urlHome = '<?php echo get_home_url() ?>';
    var idPerson = '001 <?php //echo $_SESSION['personId'] 
    ?>';
    var session;

    Date.prototype.addMins = function (m) {
        this.setTime(this.getTime() + (m * 60 * 1000)); // minutos * seg * milisegundos
        return this;
    }

    var currentDatePrevious = "<?php date_default_timezone_set($timezone);
    echo str_replace(" ", "T", date('Y-m-d H:i', (time() + 60 * 2))); ?>";
    var currentDateNext = "<?php date_default_timezone_set($timezone);
    echo str_replace(" ", "T", date('Y-m-d H:i', (time() + 60 * 0))); ?>";

    function updateInformation() {

        currentDatePrevious = new Date(currentDatePrevious);
        currentDateNext = new Date(currentDateNext);

        minutoSumar = 1;

        currentDatePrevious.addMins(minutoSumar);
        currentDateNext.addMins(minutoSumar);

        var Person_Id = '001 <?php //$_SESSION['personId'] 
        ?>';
        var homeUrl = '<?php echo get_home_url() ?>';

        for (var i = 0; i < session.length; i++) {

            var sessionDate = session[i]['session_day'] + "T" + session[i]['start_time'].trim();
            sessionDate = new Date(sessionDate);

            var sessionEndDate = session[i]['session_day'] + "T" + session[i]['end_time'].trim();
            sessionEndDate = new Date(sessionEndDate);
        }
    } //updateInformation
</script>

<?php
/*
 * Speakers modal area
 */
$avatar = get_template_directory_uri() . "/assets/images/speaker_avatar.jpg";
?>
<style>
    .modal-body .ratio-1x1 {
        width: 50%;
        margin: 0 auto;
    }

    .modal-content {
        box-shadow: 0px 4px 8px #00000029;
        border-radius: 10px;
    }

    .ratio-1x1 img,
    .ratio-1x1 svg {
        object-fit: cover;
    }

    .ratio-1x1 {
        --bs-aspect-ratio: 100%;
    }

    .ratio {
        position: relative;
        width: 100%;
    }

    .ratio::before {
        display: block;
        padding-top: var(--bs-aspect-ratio);
        content: "";
    }

    .ratio>* {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /*
    /* Bootstrap Media Query
    */

    /* X-Small devices (portrait phones, less than 576px)
            No media query for `xs` since this is the default in Bootstrap */

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {}

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {}

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .modal-body .ratio-1x1 {
            width: 40%;
        }
    }

    /* X-Large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
        .modal-body {
            padding-left: 3rem;
            padding-right: 3rem;
            padding-bottom: 1.5rem;
        }
    }

    /* XX-Large devices (larger desktops, 1400px and up) */
    @media (min-width: 1400px) {}
</style>
<?php

//creating the modals
$speakers = synclogic_get_all_speakers();
$modals = "";
foreach ($speakers as $speaker) {
    $id = $speaker->speaker_id;
    $image = $speaker->image_profile;
    $name = $speaker->speaker_name;
    $last_name = $speaker->speaker_family_name;
    $company = $speaker->company;
    $job_title = $speaker->job_title;
    $biography = $speaker->biography;
    if ($biography == "<p>0</p>" || empty($biography)) {
        $biography = "";
    }

    if (empty($image) || (substr($image, -2) == "/0")) {
        $image = $avatar;
    }

    ?>
    <div class="modal fade" id="speaker-<?= $id ?>" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="speaker-<?= $id ?>-Label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal_dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_body_left">
                        <div class="ratio ratio-1x1 modal_body_left_img">
                            <img loading="lazy" class="img-fluid d-block mx-auto rounded-circle" src="<?= $image ?>">
                        </div>
                        <div class="modal_body_left">
                            <div class="speaker-modal-information">
                                <div class="modal_dialog_content_body_left_name"><strong>
                                        <?php echo $name . " " . $last_name ?>
                                    </strong></div>
                                <div class="speaker-information">
                                    <div class="modal_dialog_content_body_left_companyname">
                                        <?= $company ?>
                                    </div>
                                    <div class="modal_dialog_content_body_left_jobtitle">
                                        <?= $job_title ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal_body_right">
                        <div class="text-start speaker-information">
                            <?= $biography ?>
                        </div>
                    </div>
                </div>
                <?php
                $sessions = get_sessions_by_speaker_id($speaker->speaker_id);
                if ($sessions): ?>
                    <div class="modal-footer modal_dialog_content_footer d-block">
                        <?php
                        foreach ($sessions as $key => $session) {
                            $session_title = $session->session_title ?? null;
                            $session_day_name = $session->session_day_name ?? null;
                            $start_time = $session->start_time ?? null;
                            $end_time = $sessions->end_time ?? null;

                            $rol = "| ";
                            if ($session->IsChair):
                                $rol .= $captions['chair'];
                            elseif ($session->IsCoChair):
                                $rol .= $captions['co_chair'];
                            elseif ($session->IsSpeaker):
                                $rol .= $captions['speaker'];
                            endif;

                            $presentations = get_presentations_by_speaker_and_author($speaker->speaker_id, $speaker->speaker_email, $session->session_id);
                            ?>
                            <div class="modal_dialog_content_footer_session">
                                <?php if ($session_title): ?>
                                    <div>
                                        <div class="modal_dialog_content_footer_session_title">
                                            <?= $session->session_title; ?>
                                        </div>
                                        <div class="modal_dialog_content_footer_session_rol">
                                            <?= $rol; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <?php if ($session_day_name): ?>
                                        <div class="modal_dialog_content_footer_session_day_name">
                                            <?= $session->session_day_name; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($start_time): ?>
                                        <div class="modal_dialog_content_footer_session_time">
                                            <?php if ($session->start_time):
                                                echo " | " . $session->start_time;
                                                if ($end_time):
                                                    echo " - " . $end_time;
                                                endif;
                                            endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($speakers_modal['link_to_programme'] == "link_to_programme"):
                                    $programme_page_link = isset($speakers_modal['programme_page_link']) ? $speakers_modal['programme_page_link'] : null;
                                    if ($programme_page_link):
                                        $getTab = getDayProgrammeTab($session->session_day); ?>
                                        <div>
                                            <a
                                                href="<?= $programme_page_link . "?DayTab=" . $getTab . "&SessionId=" . $session->session_id ?>">
                                                <?= $speakers_modal['programme_link_caption'] ?>
                                            </a>
                                        </div>
                                    <?php endif;
                                endif; ?>
                                <?php if (count($presentations) > 0): ?>
                                    <div class="modal_dialog_content_footer_session_presentations">
                                        <?php
                                        if ($captions['presentations_title']): ?>
                                            <div class="modal_dialog_content_footer_session_presentations_title">
                                                <?= $captions['presentations_title'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <ul class="modal_dialog_content_footer_session_presentations_presentation">
                                            <?php foreach ($presentations as $key => $presentation) {
                                                if ($presentation->presentation_title != ""): ?>
                                                    <li class="modal_dialog_content_footer_session_presentations_presentation_title">
                                                        <?= $presentation->presentation_title ?>
                                                    </li>
                                                <?php endif; ?>
                                            <?php } //foreach 
                                            ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php

}