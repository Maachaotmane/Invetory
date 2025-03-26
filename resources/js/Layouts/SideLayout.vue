<template>
  <div class="sidebar overflow-auto" id="sidebar">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul class="mt-3 submenu-ul">
        <h4 class="submenu-hdr fs-6">Articles</h4>
        <li class="submenu-li">
          <Link href="/products" class="side-links"><i data-name="grid" data-tags="" data-type="grid"
            class="vue-feather vue-feather--grid"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-grid vue-feather__content">
              <rect x="3" y="3" width="7" height="7"></rect>
              <rect x="14" y="3" width="7" height="7"></rect>
              <rect x="14" y="14" width="7" height="7"></rect>
              <rect x="3" y="14" width="7" height="7"></rect>
            </svg></i><span>Listes des articles</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/families" class="side-links"><i data-name="speaker" data-tags="audio,music" data-type="speaker"
            class="vue-feather vue-feather--speaker"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-speaker vue-feather__content">
              <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
              <circle cx="12" cy="14" r="4"></circle>
              <line x1="12" y1="6" x2="12.01" y2="6"></line>
            </svg></i><span>Listes des familles</span></Link>
        </li>
      </ul>

      <ul class="submenu-ul">
        <h4 class="submenu-hdr fs-6">Clients</h4>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="box" data-tags="cube" data-type="box"
            class="vue-feather vue-feather--box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-box vue-feather__content">
              <path
                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
              </path>
              <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
              <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg></i><span class="">Listes des devis</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="clipboard" data-tags="copy" data-type="clipboard"
            class="vue-feather vue-feather--clipboard"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-clipboard vue-feather__content">
              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
              <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
            </svg></i><span>Listes des BLS</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="message-square" data-tags="comment,chat"
            data-type="message-square" class="vue-feather vue-feather--message-square"><svg
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-message-square vue-feather__content">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg></i><span>Les retours</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="layers" data-tags="stack" data-type="layers"
            class="vue-feather vue-feather--layers"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-layers vue-feather__content">
              <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
              <polyline points="2 17 12 22 22 17"></polyline>
              <polyline points="2 12 12 17 22 12"></polyline>
            </svg></i><span>Liste des facteures</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="codepen" data-tags="logo" data-type="codepen"
            class="vue-feather vue-feather--codepen"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-codepen vue-feather__content">
              <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
              <line x1="12" y1="22" x2="12" y2="15.5"></line>
              <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
              <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
              <line x1="12" y1="2" x2="12" y2="8.5"></line>
            </svg></i><span>Les reglements</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="bookmark" data-tags="read,clip,marker,tag"
            data-type="bookmark" class="vue-feather vue-feather--bookmark"><svg xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark vue-feather__content">
              <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg></i><span>Situation</span></Link>
        </li>
      </ul>

      <ul class="submenu-ul">
        <h4 class="submenu-hdr fs-6 text-truncate">Fournisseurs</h4>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="box" data-tags="cube" data-type="box"
            class="vue-feather vue-feather--box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-box vue-feather__content">
              <path
                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
              </path>
              <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
              <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg></i><span class="">Liste des devis</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="plus-square" data-tags="add,new" data-type="plus-square"
            class="vue-feather vue-feather--plus-square"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-plus-square vue-feather__content">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="12" y1="8" x2="12" y2="16"></line>
              <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg></i><span>Liste des receptions</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="message-square" data-tags="comment,chat"
            data-type="message-square" class="vue-feather vue-feather--message-square"><svg
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-message-square vue-feather__content">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg></i><span>Les retours</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="layers" data-tags="stack" data-type="layers"
            class="vue-feather vue-feather--layers"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-layers vue-feather__content">
              <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
              <polyline points="2 17 12 22 22 17"></polyline>
              <polyline points="2 12 12 17 22 12"></polyline>
            </svg></i><span>Liste des facteures</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="codepen" data-tags="logo" data-type="codepen"
            class="vue-feather vue-feather--codepen"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-codepen vue-feather__content">
              <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
              <line x1="12" y1="22" x2="12" y2="15.5"></line>
              <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
              <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
              <line x1="12" y1="2" x2="12" y2="8.5"></line>
            </svg></i><span>Les reglements</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links"><i data-name="bookmark" data-tags="read,clip,marker,tag"
            data-type="bookmark" class="vue-feather vue-feather--bookmark"><svg xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark vue-feather__content">
              <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg></i><span>Situation</span></Link>
        </li>
      </ul>

      <ul class="submenu-ul">
        <h4 class="submenu-hdr fs-6">Stock</h4>
        <li class="submenu-li">
          <Link href="/stock-stat" class="side-links">
          <i data-name="copy" data-tags="clone,duplicate" data-type="copy" class="vue-feather vue-feather--copy"><svg
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-copy vue-feather__content">
              <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
              <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
            </svg></i>
          <span>Etat de stock</span></Link>
        </li>
        <li class="submenu-li">
          <Link href="/" class="side-links">
          <i data-name="truck" data-tags="delivery,van,shipping,transport,lorry" data-type="truck"
            class="vue-feather vue-feather--truck"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="feather feather-truck vue-feather__content">
              <rect x="1" y="3" width="15" height="13"></rect>
              <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
              <circle cx="5.5" cy="18.5" r="2.5"></circle>
              <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg></i>
          <span>Mouvement de stock</span></Link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

</script>