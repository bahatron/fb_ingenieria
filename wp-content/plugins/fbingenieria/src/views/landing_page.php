<html>

<head>
    <!--CSS and dependencies-->
    <link rel="stylesheet" href="<?php echo FBINGENIERIA_URL. '/src/assets/css/styles.css'?>" rel="stylesheet" type="text/css">
    <?php
        global $FBIngenieria;
        if (!empty($_POST)) {
            $data = json_decode(key($_POST));
            $result = $FBIngenieria->sendMail($data);
            var_dump($result);
            die();
        }
    ?>

</head>

<body>
    <div class="container" id="fbi_landing_page" style="width: 100%">
        <section class="padding-top about-section" id="about" style="background: url(<?php echo FBINGENIERIA_URL.'/src/assets/img/about-background.jpg'?>) center / cover no-repeat">
            <p class="section-title" align="center">
                <?php echo $FBIngenieria->translate('about-us-title', $lang) ?>
            </p>
            <hr class="hr-color">
            <div class="about-box display-big" align="center">
                <div class="row">
                    <div class="col-md-6 about-us-box border-down" align="left">
                        <div class="col-md-3" style="padding:0px;"><i class="fa fa-pencil custom-icon"></i></div>
                        <div class="col-md-9.1" style="padding:0px;">
                            <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-1', $lang) ?></span>
                            <span style="display:block;"><?php echo $FBIngenieria->translate('about-us-text-1', $lang) ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 about-us-box border-down border-center" align="right">
                        <div class="col-md-9 " style="padding:0px;">
                            <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-2', $lang) ?></span>
                            <span style="display:block;"><?php echo $FBIngenieria->translate('about-us-text-2', $lang) ?></span>
                        </div>
                        <div class="col-md-3" style="padding:0px;"> <i class="material-icons custom-icon">format_paint</i></div>

                    </div>
                </div>
                <div class="floater"></div>
                <div class="row">
                    <div class="col-md-6 about-us-box" align="left">
                        <div class="col-md-3" style="padding:0px;"><i class="fa fa-wrench custom-icon"></i></div>
                        <div class="col-md-9.1" style="padding:0px;">
                            <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-3', $lang) ?></span>
                            <span style="display:block;"><?php echo $FBIngenieria->translate('about-us-text-3', $lang) ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 about-us-box border-center" align="right">
                        <div class="col-md-9" style="padding:0px;">
                            <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-4', $lang) ?></span >
                                <span style="display:block;"><?php echo $FBIngenieria->translate('about-us-text-4', $lang) ?></span>
                        </div>
                        <div class="col-md-3" style="padding:0px;"><i class="fa fa-comments custom-icon"></i></div>

                    </div>
                </div>
            </div>
            <!--When Screen under 1200px-->
            <div class="about-box display-small" align="center">
                <div class="box-for-about">
                    <i class="fa fa-pencil custom-icon"></i>
                    <div>
                        <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-1', $lang) ?></span >
                            <span class="about-span-small"><?php echo $FBIngenieria->translate('about-us-text-1', $lang) ?></span>
                    </div>
                </div>
                <div class="box-for-about">
                    <i class="material-icons custom-icon">format_paint</i>
                    <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-2', $lang) ?></span >
                        <span class="about-span-small"><?php echo $FBIngenieria->translate('about-us-text-2', $lang) ?></span>
                </div>
                <div class="box-for-about">
                    <i class="fa fa-wrench custom-icon"></i>
                    <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-3', $lang) ?></span >
                        <span class="about-span-small"><?php echo $FBIngenieria->translate('about-us-text-3', $lang) ?></span>
                </div>
                <div class="box-for-about">
                    <i class="fa fa-comments custom-icon"></i>
                    <span class="about-span"><?php echo $FBIngenieria->translate('about-us-subtitle-4', $lang) ?></span >
                        <span class="about-span-small"><?php echo $FBIngenieria->translate('about-us-text-4', $lang) ?></span>
                </div>
            </div>
        </section>
        <section class="spacing">
        </section>
        <section class="padding-top" id="whyus">
            <p class="section-title" align="center">
                <?php echo $FBIngenieria->translate('why-us-title', $lang) ?>
            </p>
            <hr class="hr-color">
            <div class="row">
                <div class="col" align="center">
                    <div class="box card card__box">
                        <span class="label">01</span>
                        <h6 class="label2">
                            <?php echo $FBIngenieria->translate('why-us-subtitle-1', $lang) ?>
                        </h6>
                        <span class="whyus-p"><?php echo $FBIngenieria->translate('why-us-text-1', $lang) ?></span>
                    </div>
                    <div class="box card card__box">
                        <span class="label">02</span>
                        <h6 class="label2">
                            <?php echo $FBIngenieria->translate('why-us-subtitle-2', $lang) ?>
                        </h6>
                        <span class="whyus-p"><?php echo $FBIngenieria->translate('why-us-text-2', $lang) ?></span>
                    </div>
                    <div class="box card card__box">
                        <span class="label">03</span>
                        <h6 class="label2">
                            <?php echo $FBIngenieria->translate('why-us-subtitle-3', $lang) ?>
                        </h6>
                        <span class="whyus-p"><?php echo $FBIngenieria->translate('why-us-text-3', $lang) ?></span>
                    </div>
                    <div class="box card card__box">
                        <span class="label">04</span>
                        <h6 class="label2">
                            <?php echo $FBIngenieria->translate('why-us-subtitle-4', $lang) ?>
                        </h6>
                        <span class="whyus-p"><?php echo $FBIngenieria->translate('why-us-text-4', $lang) ?></span>
                    </div>
                </div>
        </section>
        <section class="padding-top project-portfolio" id="portfolio">
            <p class="section-title" align="center">
                <?php echo $FBIngenieria->translate('portfolio-title', $lang) ?>
            </p>
            <hr class="hr-color">
            <v-layout class="project-filter" row wrap>
                <v-flex xs12 class="project-filter-list">
                    <v-chip class="white--text" @click.native="changeFilter('selectedCountryFilter', filter)" :style="isCountryFilterSelected(filter)"
                        v-for="filter in countryFilters">{{filter.name}}</v-chip>
                </v-flex>
                <v-flex xs12 class="project-filter-list">
                    <v-chip class="white--text" @click.native="changeFilter('selectedAreaFilter', filter)" :style="isAreaFilterSelected(filter)"
                        v-for="filter in areaFilters">{{filter.name}}</v-chip>
                </v-flex>
                <v-flex xs12 class="project-filter-list">
                    <v-chip class="white--text" @click.native="changeFilter('selectedTypeFilter', filter)" :style="isTypeFilterSelected(filter)"
                        v-for="filter in typeFilters">{{filter.name}}</v-chip>
                </v-flex>
            </v-layout>
            {{dividedProjects}}
            <v-carousel class="portfolio-carousel" v-if="dividedProjects.length > 0">
                <v-carousel-item v-for="list in dividedProjects">
                    <v-layout row wrap v-if="list">
                        <v-flex xs12 md3 v-for="project in list">
                            <div class="p-box ">
                                <img v-if="project.images.length === 0" src="" alt="">
                                <img v-else :src="getBackgroundImage(project)" class="portoflio-img">
                                <div class="p-hover">
                                    <br>
                                    <br>
                                    <div class="portfolio-item">

                                        <a @click="showDialog($event, project)"><i class="material-icons i-hover">menu</i></a>

                                        <p>{{project.project_name}}</p>
                                    </div>
                                </div>
                        </v-flex>
                    </v-layout>
                </v-carousel-item>
            </v-carousel>
        </section>
        <section class="padding-top-journey" id="journey" style="position: relative;">
            <div class="card_journey" style="background: url(<?php echo FBINGENIERIA_URL.'/src/assets/img/journey.png' ?>) center center / cover no-repeat">
                <p class="p-journey">
                    <?php echo $FBIngenieria->translate('journey-title', $lang) ?>
                </p>
                <hr class="hr-color hr-journey" width="20%">
                <div class="div-journey">
                    <p class="text-journey">
                        <?php echo $FBIngenieria->translate('journey-text-1', $lang) ?> <br>
                        <?php echo $FBIngenieria->translate('journey-text-2', $lang) ?>
                    </p>
                    <p>
                        <a href="#portfolio" class="btn" style="background-color:#fb6816; box-shadow:none;color:white;"><?php echo $FBIngenieria->translate('journey-botton', $lang) ?></a>
                    </p>
                </div>
            </div>
        </section>
        <section class="padding-top" id="clients">
            <p class="section-title" align="center">
                <?php echo $FBIngenieria->translate('clients-title', $lang) ?>
            </p>
            <hr class="hr-color">
            <span class="clients-p"><?php echo $FBIngenieria->translate('clients-text', $lang) ?></span>
            <div class="client-carousel" v-if="clientList.length > 0">
                <v-carousel cycle="false" class="client-carousel">
                    <v-carousel-item v-for="client in clientList">
                        <a :href="client.websiteUrl"><img :src="client.imageUrl" style="height:100px;width:auto;"></a>
                    </v-carousel-item>
                </v-carousel>
            </div>
        </section>
        <section class="padding-top contact-section" id="contact">
            <p class="section-title" align="center">
                <?php echo $FBIngenieria->translate('contact-title', $lang) ?>
            </p>
            <div class="row" style="position: relative;  overflow: hidden;">
                <div class="col-md-3"></div>
                <div class=" col-md-6 contact-form" style="height:auto; padding:90px;">
                    <form name="contact-form" action="" method="POST" @submit.prevent="sendContactForm()">
                        <div class="col-md-6" align="center">
                            <div class="row">
                                <input type="text" name="name" value="" placeholder="<?php echo $FBIngenieria->translate('contact-name', $lang) ?>" required>
                            </div>
                            <div class="row">
                                <input type="text" name="lastname" value="" placeholder="<?php echo $FBIngenieria->translate('contact-lastname', $lang) ?>"
                                    required>
                            </div>
                            <div class="row">
                                <input type="email" name="mail" value="" placeholder="<?php echo $FBIngenieria->translate('contact-mail', $lang) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6" align="center">
                            <textarea rows="4" cols="2" name="comment" placeholder="<?php echo $FBIngenieria->translate('contact-comment', $lang) ?>"
                                required>
                            </textarea>
                            <input type="submit" name="submit" value="<?php echo $FBIngenieria->translate('contact-button', $lang) ?>" class="btn" style="background-color:#fb6816; box-shadow:none;">
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <i class="material-icons contact-icon" style="position:absolute;">mail_outline</i>
            </div>
        </section>
        <v-dialog v-model="dialogOpen" width="756">
            <v-card style="padding:12px;" v-if="selectedProject">
                <v-card-row>
                    <a :href="selectedProject.websiteUrl"><img :src="selectedProject.imageUrl" style="width:100px;"></a>
                    <v-card-title>{{selectedProject.project_name}}</v-card-title>
                </v-card-row>
                <v-card-row>
                    <p style="font-size:0.89em;text-align:justify;">
                        {{selectedProject.shortDescription}}
                    </p>
                </v-card-row>
                <v-card-row>
                    <p style="font-size:1em;text-align:justify;">
                        {{selectedProject.longDescription}}
                    </p>
                </v-card-row>
                <v-card-row>
                    <v-carousel cycle="false" class="modal-carousel">
                        <v-carousel-item v-for="image in selectedProject.images">
                            <img :src="image.url" style="height:40vh;width:auto;">
                        </v-carousel-item>
                    </v-carousel>
                </v-card-row>
            </v-card>
        </v-dialog>
    </div>
</body>
<script>
    new Vue({
        el: '#fbi_landing_page',
        data: {
            clientList: JSON.parse('<?php echo json_encode($FBIngenieria->getActiveClients()) ?>'),
            projectList: JSON.parse('<?php echo json_encode($FBIngenieria->getActiveProjects($lang)) ?>'),
            dialogOpen: false,
            selectorColor: '#fb6816',
            availableColor: '#202835',
            selectedProject: {},
            countryFilters: JSON.parse('<?php echo json_encode($FBIngenieria->getCountryFilters($lang)) ?>'),
            selectedCountryFilter: null,
            areaFilters: JSON.parse('<?php echo json_encode($FBIngenieria->getAreaFilters($lang)) ?>'),
            selectedAreaFilter: null,
            typeFilters: JSON.parse('<?php echo json_encode($FBIngenieria->getTypeFilters($lang)) ?>'),
            selectedTypeFilter: null
        },
        mounted: function () {
        },
        methods: {
            changeFilter: function (filter, value) {
                this[filter] = this[filter] !== value ? value : null;
                this.checkAreaFilters()
            },
            checkAreaFilters: function(){
                if(this.selectedAreaFilter !== null){
                    if(this.selectedTypeFilter !== null && this.selectedTypeFilter.area !== this.selectedAreaFilter.id){
                        this.selectedTypeFilter = null;
                    }
                } else {
                    this.selectedTypeFilter = null;
                }
            },
            showDialog: function (event, project) {
                event.stopPropagation();
                this.selectedProject = project;
                this.dialogOpen = !this.dialogOpen;
            },
            ajax: function (data) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        alert("<?php echo $FBIngenieria->translate('THANK_YOU_CONTACT', $lang)?>");
                    }
                };
                xmlhttp.open("POST", '', true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(data);
            },
            sendContactForm: function () {
                this.ajax(JSON.stringify(this.contact));
                return false;
            },
            getBackgroundImage(project) {
                return project.images.length > 0 ? project.images[0].url : '';
            }
        },
        computed: {
            dividedProjects: function (){
                var projects = this.filteredProjects;
                if(!projects){
                    return false;
                }
                var inner = [];
                var outer = [];
                for(var i=0; i < projects.length; i++){
                    inner.push(projects[i]);
                    if(i !== 0 && i % 8 === 0){
                        outer.push(inner);
                        inner = [];
                    }
                }
                if(inner.length > 0 ){
                    outer.push(inner);
                }
                return outer;
            },
            filteredProjects: function () {
                var countryFilter = this.selectedCountryFilter;
                var areaFilter = this.selectedAreaFilter;
                var typeFilter = this.selectedTypeFilter;
                return this.projectList.reduce(function(acum, item, index){
                    var valid = true;
                    if(countryFilter && countryFilter.name !== item.country){
                        valid = false;
                    }
                    if(areaFilter && areaFilter.name !== item.area){
                        valid = false;
                    }
                    if(typeFilter && typeFilter.name !== item.type){
                        valid = false;
                    }
                    if(valid){
                        acum.push(item);
                    }
                    return acum;
                }, []);
            },
            isCountryFilterSelected: function () {
                return function (filter) {
                    return {
                        'background-color': this.selectedCountryFilter === filter ? this.selectorColor : this.availableColor,
                        'border-color': this.selectedCountryFilter === filter ? this.selectorColor : this.availableColor
                    };
                }
            },
            isAreaFilterSelected: function () {
                return function (filter) {
                    return {
                        'background-color': this.selectedAreaFilter === filter ? this.selectorColor : this.availableColor,
                        'border-color': this.selectedAreaFilter === filter ? this.selectorColor : this.availableColor
                    };
                }
            },
            isTypeFilterSelected: function () {
                return function (filter) {
                    if(!this.selectedAreaFilter || filter.area !== this.selectedAreaFilter.id){
                        return {
                            'background-color': 'grey',
                            'border-color': 'grey'
                        }
                    } else if (filter.area === this.selectedAreaFilter.id) {
                         return {
                            'background-color': this.selectedTypeFilter === filter ? this.selectorColor : this.availableColor,
                            'border-color': this.selectedTypeFilter === filter ? this.selectorColor : this.availableColor
                        };
                    }
                }
            }
        }
    })

</script>

</html>