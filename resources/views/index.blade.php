<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Raspagem</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
        /**
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

        html, body {
            font-family: 'Roboto', 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
        }
        .mdl-demo .mdl-layout__header-row {
            padding-left: 40px;
        }
        .mdl-demo .mdl-layout.is-small-screen .mdl-layout__header-row h3 {
            font-size: inherit;
        }
        .mdl-demo .mdl-layout__tab-bar-button {
            display: none;
        }
        .mdl-demo .mdl-layout.is-small-screen .mdl-layout__tab-bar .mdl-button {
            display: none;
        }
        .mdl-demo .mdl-layout:not(.is-small-screen) .mdl-layout__tab-bar,
        .mdl-demo .mdl-layout:not(.is-small-screen) .mdl-layout__tab-bar-container {
            overflow: visible;
        }
        .mdl-demo .mdl-layout__tab-bar-container {
            height: 64px;
        }
        .mdl-demo .mdl-layout__tab-bar {
            padding: 0;
            padding-left: 16px;
            box-sizing: border-box;
            height: 100%;
            width: 100%;
        }
        .mdl-demo .mdl-layout__tab-bar .mdl-layout__tab {
            height: 64px;
            line-height: 64px;
        }
        .mdl-demo .mdl-layout__tab-bar .mdl-layout__tab.is-active::after {
            background-color: white;
            height: 4px;
        }
        .mdl-demo main > .mdl-layout__tab-panel {
            padding: 8px;
            padding-top: 48px;
        }
        .mdl-demo .mdl-card {
            height: auto;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .mdl-demo .mdl-card > * {
            height: auto;
        }
        .mdl-demo .mdl-card .mdl-card__supporting-text {
            margin: 40px;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            padding: 0;
            color: inherit;
            width: calc(100% - 80px);
        }
        .mdl-demo.mdl-demo .mdl-card__supporting-text h4 {
            margin-top: 0;
            margin-bottom: 20px;
        }
        .mdl-demo .mdl-card__actions {
            margin: 0;
            padding: 4px 40px;
            color: inherit;
        }
        .mdl-demo .mdl-card__actions a {
            color: #00BCD4;
            margin: 0;
        }
        .mdl-demo .mdl-card__actions a:hover,
        .mdl-demo .mdl-card__actions a:active {
            color: inherit;
            background-color: transparent;
        }
        .mdl-demo .mdl-card__supporting-text + .mdl-card__actions {
            border-top: 1px solid rgba(0, 0, 0, 0.12);
        }
        .mdl-demo #add {
            position: absolute;
            right: 40px;
            top: 36px;
            z-index: 999;
        }

        .mdl-demo .mdl-layout__content section:not(:last-of-type) {
            position: relative;
            margin-bottom: 48px;
        }
        .mdl-demo section.section--center {
            max-width: 860px;
        }
        .mdl-demo #features section.section--center {
            max-width: 620px;
        }
        .mdl-demo section > header{
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .mdl-demo section > .section__play-btn {
            min-height: 200px;
        }
        .mdl-demo section > header > .material-icons {
            font-size: 3rem;
        }
        .mdl-demo section > button {
            position: absolute;
            z-index: 99;
            top: 8px;
            right: 8px;
        }
        .mdl-demo section .section__circle {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-flex-grow: 0;
            -ms-flex-positive: 0;
            flex-grow: 0;
            -webkit-flex-shrink: 1;
            -ms-flex-negative: 1;
            flex-shrink: 1;
        }
        .mdl-demo section .section__text {
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            padding-top: 8px;
        }
        .mdl-demo section .section__text h5 {
            font-size: inherit;
            margin: 0;
            margin-bottom: 0.5em;
        }
        .mdl-demo section .section__text a {
            text-decoration: none;
        }
        .mdl-demo section .section__circle-container > .section__circle-container__circle {
            width: 64px;
            height: 64px;
            border-radius: 32px;
            margin: 8px 0;
        }
        .mdl-demo section.section--footer .section__circle--big {
            width: 100px;
            height: 100px;
            border-radius: 50px;
            margin: 8px 32px;
        }
        .mdl-demo .is-small-screen section.section--footer .section__circle--big {
            width: 50px;
            height: 50px;
            border-radius: 25px;
            margin: 8px 16px;
        }
        .mdl-demo section.section--footer {
            padding: 64px 0;
            margin: 0 -8px -8px -8px;
        }
        .mdl-demo section.section--center .section__text:not(:last-child) {
            border-bottom: 1px solid rgba(0,0,0,.13);
        }
        .mdl-demo .mdl-card .mdl-card__supporting-text > h3:first-child {
            margin-bottom: 24px;
        }
        .mdl-demo .mdl-layout__tab-panel:not(#overview) {
            background-color: white;
        }
        .mdl-demo #features section {
            margin-bottom: 72px;
        }
        .mdl-demo #features h4, #features h5 {
            margin-bottom: 16px;
        }
        .mdl-demo .toc {
            border-left: 4px solid #C1EEF4;
            margin: 24px;
            padding: 0;
            padding-left: 8px;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .mdl-demo .toc h4 {
            font-size: 0.9rem;
            margin-top: 0;
        }
        .mdl-demo .toc a {
            color: #4DD0E1;
            text-decoration: none;
            font-size: 16px;
            line-height: 28px;
            display: block;
        }
        .mdl-demo .mdl-menu__container {
            z-index: 99;
        }


    </style>
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
            <h3>Raspagem </h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
            <a href="{{route('pullcnpq')}}" class="mdl-layout__tab">Busca tudo CNPQ</a>
        </div>
    </header>
    <main class="mdl-layout__content">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            @foreach($biddings as $b)
            <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
                <div class="mdl-card mdl-cell mdl-cell--12-col">
                    <div class="mdl-card__supporting-text">
                        <h4>{{$b->origin or null}} - {{$b->name or null}}</h4>
                        Abertura: {{$b->starting_date or null}}<br/>
                        <h6>Objetivo:</h6>
                        {{$b->object or null}}
                    </div>
                    <div class="mdl-card__actions">
                        @forelse($b->appends as $a)
                            <li class="mdl-list__item">
                                <a href="{{route('download',$a->id)}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                            <span class="mdl-list__item-primary-content">
                                                <i class="material-icons">&#xE226;</i>{{$a->name or null}}
                                            </span>
                                </a>
                            </li>
                        @empty
                            <li>Nenhum anexo</li>
                        @endforelse
                    </div>
                </div>
            </section>
            @endforeach
                {{ $biddings->links() }}
        </div>
    </main>
</div>

<script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>

