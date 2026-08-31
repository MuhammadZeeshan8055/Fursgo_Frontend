(function () {
    const config = window.messagesPageConfig;
    if (!config || !Array.isArray(config.conversations)) {
        return;
    }

    const conversations = config.conversations;
    const headerRoot = document.querySelector('.chat-header');
    const messagesRoot = document.querySelector('.messages');
    const chatBox = document.querySelector('.chat-box');
    const footerNote = document.querySelector('.footer-note');
    const chatPanel = document.querySelector('.chat-width');
    const sidebar = document.querySelector('.sidebar');
    const messagesTitle = document.querySelector('.messages-title');
    const settingsArchived = document.querySelector('.settings-archived');
    const exitArchivedBtn = document.querySelector('.exit-archived');
    const chatListsByTab = {
        'groomer-messages': document.querySelector('[data-tab-content="groomer-messages"] .chat-list'),
        'space-messages': document.querySelector('[data-tab-content="space-messages"] .chat-list')
    };

    if (!headerRoot || !messagesRoot || !chatBox || !footerNote) {
        return;
    }

    let activeConversationId = null;
    let showingArchived = false;
    let activeFilter = null;

    const filterCheckSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>`;

    const sendSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M18.2448 0.0763204C19.2868 -0.287756 20.2878 0.713198 19.9237 1.75518L13.8471 19.118C13.4522 20.2441 11.8831 20.3077 11.399 19.2175L8.46685 12.6211L12.5938 8.49316C12.7297 8.34735 12.8036 8.15449 12.8001 7.95522C12.7966 7.75595 12.7159 7.56583 12.575 7.4249C12.434 7.28398 12.2439 7.20325 12.0446 7.19974C11.8454 7.19622 11.6525 7.27019 11.5067 7.40605L7.3787 11.5329L0.782123 8.60084C-0.308075 8.11575 -0.243464 6.54765 0.881605 6.15281L18.2448 0.0763204Z" fill="white" />
    </svg>`;

    const attachmentActions = `
        <div class="actions-row">
            <label class="action dark-color-font">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                    <path d="M10.5 6.04469L6.17551 10.5107C5.54818 11.1481 4.70239 11.5037 3.82235 11.5C2.94232 11.4963 2.09936 11.1336 1.47707 10.4909C0.854792 9.8483 0.503611 8.97775 0.500028 8.06891C0.496444 7.16008 0.840748 6.2866 1.45794 5.63874L5.78243 1.17272C5.98895 0.95944 6.23412 0.790259 6.50395 0.674834C6.77378 0.559409 7.06298 0.5 7.35504 0.5C7.64711 0.5 7.93631 0.559409 8.20614 0.674834C8.47597 0.790259 8.72114 0.95944 8.92766 1.17272C9.13418 1.386 9.298 1.63919 9.40977 1.91785C9.52153 2.19652 9.57906 2.49518 9.57906 2.7968C9.57906 3.09842 9.52153 3.39709 9.40977 3.67575C9.298 3.95441 9.13418 4.20761 8.92766 4.42089L4.60317 8.88691C4.3946 9.10231 4.1117 9.22333 3.81673 9.22333C3.52175 9.22333 3.23886 9.10231 3.03028 8.88691C2.8217 8.6715 2.70452 8.37935 2.70452 8.07472C2.70452 7.77009 2.8217 7.47794 3.03028 7.26254L6.96168 3.20304" stroke="#3B3731" stroke-linecap="round" />
                </svg>
                Attach
                <input type="file" />
            </label>
            <div class="divider"></div>
            <label class="action dark-color-font">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M10.2778 0.5H1.72222C1.04721 0.5 0.5 1.04721 0.5 1.72222V10.2778C0.5 10.9528 1.04721 11.5 1.72222 11.5H10.2778C10.9528 11.5 11.5 10.9528 11.5 10.2778V1.72222C11.5 1.04721 10.9528 0.5 10.2778 0.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4.16662 5.3889C4.84163 5.3889 5.38884 4.84169 5.38884 4.16668C5.38884 3.49167 4.84163 2.94446 4.16662 2.94446C3.4916 2.94446 2.9444 3.49167 2.9444 4.16668C2.9444 4.84169 3.4916 5.3889 4.16662 5.3889Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.5001 7.83346L9.61421 5.94757C9.38501 5.71844 9.07419 5.58972 8.7501 5.58972C8.42601 5.58972 8.11519 5.71844 7.88599 5.94757L2.33344 11.5001" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Upload
                <input type="file" accept="image/*" />
            </label>
            <div class="counter fs-14-400-f-color">
                <span id="count">0</span>/3,000
            </div>
        </div>`;

    function getBadgeSvg(type) {
        return type === 'groomer'
            ? `<svg xmlns="http://www.w3.org/2000/svg" width="21" height="23" viewBox="0 0 21 23" fill="none">
                <ellipse cx="10.9241" cy="11.3744" rx="6.44549" ry="6.06626" fill="white" />
                <path d="M10.6272 0.127384C10.4511 0.0439255 10.2623 0 10.0652 0C9.86812 0 9.6794 0.0439255 9.50326 0.127384L1.60626 3.63703C0.683615 4.04554 -0.00417476 4.99872 1.90757e-05 6.14957C0.0209883 10.507 1.73207 18.4795 8.95806 22.1033C9.65843 22.4547 10.472 22.4547 11.1724 22.1033C18.3984 18.4795 20.1095 10.507 20.1304 6.14957C20.1346 4.99872 19.4469 4.04554 18.5242 3.63703L10.6272 0.127384ZM6.07689 12.5715C6.2782 12.6242 6.49208 12.6505 6.71016 12.6505C8.19059 12.6505 9.39422 11.3899 9.39422 9.83931V7.02808H11.2479C11.7554 7.02808 12.2209 7.32677 12.4473 7.80556L12.7493 8.43369H15.4333C15.8024 8.43369 16.1044 8.74996 16.1044 9.1365V10.5421C16.1044 12.4836 14.603 14.0562 12.7493 14.0562H10.7362V16.2832C10.7362 16.6038 10.4888 16.8674 10.1785 16.8674C10.103 16.8674 10.0275 16.8498 9.96039 16.8191L5.82107 14.961C5.54428 14.838 5.36813 14.5525 5.36813 14.2406C5.36813 14.1177 5.3933 13.9991 5.44782 13.8892L6.07689 12.5715ZM6.03915 7.02808H8.05219V9.83931C8.05219 10.6168 7.45247 11.2449 6.71016 11.2449C5.96785 11.2449 5.36813 10.6168 5.36813 9.83931V7.73089C5.36813 7.34434 5.67009 7.02808 6.03915 7.02808ZM11.4073 9.1365C11.4073 8.9501 11.3366 8.77134 11.2107 8.63954C11.0849 8.50774 10.9142 8.43369 10.7362 8.43369C10.5583 8.43369 10.3876 8.50774 10.2618 8.63954C10.1359 8.77134 10.0652 8.9501 10.0652 9.1365C10.0652 9.3229 10.1359 9.50166 10.2618 9.63346C10.3876 9.76526 10.5583 9.83931 10.7362 9.83931C10.9142 9.83931 11.0849 9.76526 11.2107 9.63346C11.3366 9.50166 11.4073 9.3229 11.4073 9.1365Z" fill="#C9DDA0" />
            </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 20 22" fill="none">
                <path d="M10.5114 0.120327C10.3372 0.0415119 10.1505 3.05176e-05 9.95555 3.05176e-05C9.76059 3.05176e-05 9.57393 0.0415119 9.3997 0.120327L1.58876 3.43469C0.676166 3.82047 -0.00412927 4.72061 1.88678e-05 5.80743C0.0207596 9.92238 1.7132 17.4513 8.86045 20.8735C9.55319 21.2053 10.3579 21.2053 11.0507 20.8735C18.1979 17.4513 19.8903 9.92238 19.9111 5.80743C19.9152 4.72061 19.2349 3.82047 18.3224 3.43469L10.5114 0.120327Z" fill="#CBDCE8" />
                <path d="M15.3611 5.76004L11.094 10.2939M9.19828 10.0725C7.87547 10.5803 6.81775 10.4934 5.76003 10.0741C6.02673 13.5108 7.62904 14.832 9.76527 15.3611C9.76527 15.3611 11.3745 14.2228 11.6065 11.5244C11.6316 11.2321 11.6439 11.0865 11.5836 10.9217C11.5228 10.7569 11.4033 10.639 11.1649 10.4027C10.7723 10.0144 10.5766 9.82022 10.3435 9.77115C10.1104 9.72314 9.80635 9.83942 9.19828 10.0725Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6.5603 12.9327C6.5603 12.9327 7.89378 13.1909 9.22726 12.1614" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.69331 8.02663C8.69331 8.20346 8.62307 8.37305 8.49803 8.49809C8.37299 8.62313 8.2034 8.69337 8.02657 8.69337C7.84974 8.69337 7.68015 8.62313 7.55512 8.49809C7.43008 8.37305 7.35983 8.20346 7.35983 8.02663C7.35983 7.8498 7.43008 7.68022 7.55512 7.55518C7.68015 7.43014 7.84974 7.35989 8.02657 7.35989C8.2034 7.35989 8.37299 7.43014 8.49803 7.55518C8.62307 7.68022 8.69331 7.8498 8.69331 8.02663Z" fill="#CBDCE8" stroke="white" />
                <path d="M10.0268 6.2937V6.34704" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            </svg>`;
    }

    function getConversationById(conversationId) {
        return conversations.find((conversation) => conversation.id === conversationId);
    }

    function getActiveTabId() {
        return document.querySelector('.tablinks.active')?.dataset.tab || 'groomer-messages';
    }

    function getProfileUrl(conversation) {
        if (conversation.profileUrl) {
            return conversation.profileUrl;
        }

        const base = config.baseUrl || '';
        return conversation.list.badge === 'groomer'
            ? `${base}profiles/groomer/groomer_profile.php`
            : `${base}profiles/space/space_profile.php`;
    }

    function matchesActiveFilter(conversation) {
        if (showingArchived || !activeFilter || activeFilter === 'most-recent') {
            return true;
        }

        if (activeFilter === 'unread') {
            return conversation.list.unread === true;
        }

        if (activeFilter === 'active-bookings') {
            return true;
        }

        return true;
    }

    function sortConversations(list) {
        return [...list].sort((a, b) => (b.lastActivityAt || 0) - (a.lastActivityAt || 0));
    }

    function getVisibleConversations(tabId) {
        const filtered = conversations.filter((conversation) => {
            const matchesTab = conversation.tab === tabId;
            const matchesArchiveState = showingArchived
                ? conversation.archived === true
                : conversation.archived !== true;
            return matchesTab && matchesArchiveState && matchesActiveFilter(conversation);
        });

        return sortConversations(filtered);
    }

    function syncFilterButtons() {
        document.querySelectorAll('.filter[data-filter]').forEach((filterEl) => {
            const isActive = filterEl.dataset.filter === activeFilter;
            filterEl.classList.toggle('active', isActive);

            const existingCheck = filterEl.querySelector('svg');
            if (isActive && !existingCheck) {
                filterEl.insertAdjacentHTML('afterbegin', filterCheckSvg);
            } else if (!isActive && existingCheck) {
                existingCheck.remove();
            }
        });
    }

    function setActiveFilter(filterId) {
        // Clicking the active filter again clears it (back to full list).
        activeFilter = activeFilter === filterId ? null : filterId;
        syncFilterButtons();
        renderChatLists();
        refreshVisibleChat();
    }

    function bindFilters() {
        document.querySelectorAll('.filter[data-filter]').forEach((filterEl) => {
            filterEl.addEventListener('click', () => {
                if (showingArchived) {
                    return;
                }
                setActiveFilter(filterEl.dataset.filter);
            });
        });
    }

    function renderChatListCard(conversation) {
        const { list } = conversation;
        const countMarkup = list.count
            ? `<p class="messages-count light-color-font">${list.count}</p>`
            : '';
        const marginClass = list.cardClass ? ` ${list.cardClass}` : '';

        return `
            ${list.dividerBefore ? '<div class="section-divider mt-2 mb-2"></div>' : ''}
            <div class="chat-card${list.unread ? ' unread' : ''} cursor d-flex align-items-center gap-20${marginClass}" data-conversation-id="${conversation.id}">
                <div class="profile-pic">
                    <div class="profile-image-wrapper">
                        <img src="${list.image}" class="rounded-image" alt="">
                        <div class="top-left-svg">${getBadgeSvg(list.badge)}</div>
                    </div>
                </div>
                <div class="chat-info">
                    <div class="d-flex justify-content-between">
                        <div class="name">
                            <p class="dark-color-font">${list.name}</p>
                            <p class="simple-light-font">${list.subtitle}</p>
                        </div>
                        ${countMarkup}
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <p class="simple-font">${list.preview}</p>
                        <p class="time">${list.time}</p>
                    </div>
                </div>
            </div>
        `;
    }

    function renderEmptyListMessage() {
        return `
            <div class="chat-card d-flex align-items-center justify-content-center mt-4">
                <p class="simple-light-font">
                    ${showingArchived ? 'No archived chats yet.' : 'No chats to show.'}
                </p>
            </div>
        `;
    }

    function renderChatLists() {
        Object.entries(chatListsByTab).forEach(([tabId, listRoot]) => {
            if (!listRoot) return;

            const tabConversations = getVisibleConversations(tabId);
            listRoot.innerHTML = tabConversations.length
                ? tabConversations.map((conversation) => renderChatListCard(conversation)).join('')
                : renderEmptyListMessage();
        });

        bindConversationCards();
    }

    function refreshVisibleChat() {
        const visible = getVisibleConversations(getActiveTabId());
        if (visible.length) {
            const stillVisible = visible.some((conversation) => conversation.id === activeConversationId);
            renderChat(stillVisible ? activeConversationId : visible[0].id);
            return;
        }

        activeConversationId = null;
        messagesRoot.innerHTML = '';
        chatBox.innerHTML = '';
        footerNote.style.display = 'none';
    }

    function updateSidebarMode() {
        if (!sidebar || !messagesTitle) return;

        sidebar.classList.toggle('is-archived-view', showingArchived);
        messagesTitle.textContent = showingArchived ? 'Archived Messages' : 'Messages';

        if (settingsArchived) {
            settingsArchived.hidden = showingArchived;
        }

        if (exitArchivedBtn) {
            exitArchivedBtn.hidden = !showingArchived;
        }
    }

    function openArchivedView() {
        showingArchived = true;
        document.querySelector('.archived')?.classList.remove('show');
        updateSidebarMode();
        renderChatLists();
        refreshVisibleChat();
    }

    function closeArchivedView() {
        showingArchived = false;
        updateSidebarMode();
        renderChatLists();
        refreshVisibleChat();
    }

    function archiveActiveChat() {
        const conversation = getConversationById(activeConversationId);
        const menu = document.querySelector('.archived-chat');
        menu?.classList.remove('show');

        if (!conversation || conversation.archived) {
            return;
        }

        conversation.archived = true;
        renderChatLists();
        refreshVisibleChat();
    }

    function unarchiveActiveChat() {
        const conversation = getConversationById(activeConversationId);
        const menu = document.querySelector('.archived-chat');
        menu?.classList.remove('show');

        if (!conversation || !conversation.archived) {
            return;
        }

        conversation.archived = false;
        renderChatLists();
        refreshVisibleChat();
    }

    function toggleArchiveActiveChat() {
        const conversation = getConversationById(activeConversationId);
        if (!conversation) return;

        if (conversation.archived) {
            unarchiveActiveChat();
            return;
        }

        archiveActiveChat();
    }

    function renderMessages(chat) {
        messagesRoot.classList.remove('locked');
        messagesRoot.innerHTML = `${chat.messages.map((message) => `
            <div class="message ${message.type}">
                <div class="bubble">
                    <p class="${message.type === 'typing' ? 'normal-light-color' : 'normal-font-weight'}">
                        ${message.html}
                    </p>
                </div>
                <div class="time simple-light-font">${message.time}</div>
            </div>
        `).join('')}
        ${chat.quickReplies.length ? `
            <div class="quick-replies d-flex align-items-center justify-content-end gap-10">
                ${chat.quickReplies.map((reply) => `<button class="btn-custom btn-active-bg normal-font-bold">${reply}</button>`).join('')}
            </div>
        ` : ''}`;

        messagesRoot.scrollTo({
            top: messagesRoot.scrollHeight,
            behavior: 'smooth'
        });
    }

    function bindComposerInteractions() {
        const composerTextarea = document.getElementById('message');
        const composerCount = document.getElementById('count');
        const composerSendBtn = document.getElementById('sendBtn');
        const previewRow = document.getElementById('previewRow');

        if (composerTextarea && composerCount && composerSendBtn) {
            composerTextarea.addEventListener('input', () => {
                composerCount.textContent = composerTextarea.value.length;
                composerTextarea.style.height = 'auto';
                composerTextarea.style.height = composerTextarea.scrollHeight + 'px';
                composerSendBtn.classList.toggle('active', composerTextarea.value.trim().length > 0);
            });

            composerSendBtn.addEventListener('click', () => {
                if (!composerTextarea.value.trim()) return;

                alert('Message sent:\n\n' + composerTextarea.value);
                composerTextarea.value = '';
                composerCount.textContent = 0;
                composerSendBtn.classList.remove('active');
                composerTextarea.style.height = 'auto';
            });
        }

        if (previewRow) {
            document.querySelectorAll('.actions-row input[type="file"]').forEach((input) => {
                input.addEventListener('change', function () {
                    Array.from(this.files).forEach((file) => {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            const item = document.createElement('div');
                            item.className = 'preview-item';

                            let preview;
                            if (file.type.startsWith('image/')) {
                                preview = document.createElement('img');
                                preview.src = event.target.result;
                            } else {
                                preview = document.createElement('div');
                                preview.style.cssText = 'width:60px;height:60px;border-radius:8px;background:#f0f0f0;display:flex;flex-direction:column;align-items:center;justify-content:center;font-size:9px;color:#555;padding:4px;text-align:center;word-break:break-all;box-sizing:border-box;';
                                preview.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6M4 4h16v16H4z"/></svg>${file.name.slice(0, 12)}`;
                            }

                            const btn = document.createElement('span');
                            btn.className = 'remove-btn';
                            btn.innerHTML = '&#x2715;';
                            btn.addEventListener('click', () => item.remove());

                            item.appendChild(preview);
                            item.appendChild(btn);
                            previewRow.appendChild(item);
                        };
                        reader.readAsDataURL(file);
                    });

                    this.value = '';
                });
            });
        }
    }

    function renderComposer(chat) {
        chatBox.innerHTML = `
            <div class="preview-row" id="previewRow"></div>
            <div class="message-row">
                <div class="message-input">
                    <textarea id="message" placeholder="Write a message ..." maxlength="3000"></textarea>
                </div>
                <button class="send-btn" id="sendBtn">${sendSvg}</button>
            </div>
            ${attachmentActions}
        `;

        footerNote.textContent = chat.footerNote;
        footerNote.style.display = chat.footerNote ? 'block' : 'none';
        bindComposerInteractions();
    }

    function renderHeader(conversation) {
        const { list, detail } = conversation;
        const tag = headerRoot.querySelector('.tag');
        const statusText = headerRoot.querySelector('.tag-and-name .light-color-font');
        const statusDot = headerRoot.querySelector('.tag-and-name circle');
        const archiveMenuLabel = headerRoot.querySelector('.archived-chat .simple-font');
        const profileLink = headerRoot.querySelector('[data-profile-link]');

        headerRoot.querySelector('.rounded-image.large-size').src = list.image;
        headerRoot.querySelector('.profile-image-wrapper .top-left-svg').innerHTML = getBadgeSvg(list.badge);
        tag.textContent = detail.tag;
        const tagType = detail.tagClass || list.badge || 'groomer';
        tag.classList.toggle('groomer', tagType === 'groomer');
        tag.classList.toggle('space', tagType === 'space');
        tag.style.removeProperty('background');

        statusText.textContent = detail.availability;
        statusText.style.color = detail.availabilityColor;
        statusDot.setAttribute('fill', detail.availabilityColor);

        headerRoot.querySelector('.name-studio .dark-color-font').textContent = detail.displayName;
        headerRoot.querySelector('.name-studio .simple-light-font').textContent = detail.subtitle;
        headerRoot.querySelector('.simple-font').textContent = `Booking reference: ${detail.bookingReference}`;

        if (profileLink) {
            profileLink.href = getProfileUrl(conversation);
            profileLink.setAttribute(
                'aria-label',
                list.badge === 'groomer' ? 'View groomer profile' : 'View space profile'
            );
        }

        if (archiveMenuLabel) {
            archiveMenuLabel.textContent = conversation.archived ? 'Unarchive Chat' : 'Archive Chat';
        }
    }

    function setSelectedCard(selectedCard) {
        document.querySelectorAll('.chat-card.selected').forEach((card) => card.classList.remove('selected'));
        selectedCard.classList.add('selected');
    }

    function playChatBodyAnimation() {
        if (!chatPanel) return;

        chatPanel.classList.remove('is-switching');
        // Force a reflow so the animation can restart on each chat click.
        void chatPanel.offsetWidth;
        chatPanel.classList.add('is-switching');
    }

    function renderChat(conversationId) {
        const conversation = getConversationById(conversationId);
        if (!conversation) return;

        const isSameChat = activeConversationId === conversationId;
        const screenDetail = {
            ...conversation.detail
        };

        activeConversationId = conversationId;

        const selectedCard = document.querySelector(`[data-conversation-id="${conversationId}"]`);
        if (selectedCard) {
            setSelectedCard(selectedCard);
        }

        renderHeader(conversation);
        renderMessages(screenDetail);
        renderComposer(screenDetail);

        if (!isSameChat) {
            playChatBodyAnimation();
        }
    }

    function bindConversationCards() {
        document.querySelectorAll('.chat-card[data-conversation-id]').forEach((card) => {
            const conversationId = card.dataset.conversationId;

            card.classList.add('is-clickable');
            card.setAttribute('role', 'button');
            card.setAttribute('tabindex', '0');
            card.addEventListener('click', () => renderChat(conversationId));
            card.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    renderChat(conversationId);
                }
            });
        });
    }

    function bindMenus() {
        const settingsBtn = document.querySelector('.setting');
        const archived = document.querySelector('.archived');
        const dotsBtn = document.querySelector('.dots-svg');
        const archivedChat = document.querySelector('.archived-chat');
        const openArchivedTrigger = document.querySelector('[data-action="open-archived"]');
        const archiveChatTrigger = document.querySelector('[data-action="archive-chat"]');

        if (settingsBtn && archived) {
            settingsBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                archived.classList.toggle('show');
            });
        }

        if (dotsBtn && archivedChat) {
            dotsBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                archivedChat.classList.toggle('show');
            });
        }

        openArchivedTrigger?.addEventListener('click', (event) => {
            event.stopPropagation();
            openArchivedView();
        });

        archiveChatTrigger?.addEventListener('click', (event) => {
            event.stopPropagation();
            toggleArchiveActiveChat();
        });

        exitArchivedBtn?.addEventListener('click', closeArchivedView);

        document.addEventListener('click', () => {
            archived?.classList.remove('show');
            archivedChat?.classList.remove('show');
        });
    }

    function bindTabThemeColors() {
        const theme = {
            'groomer-messages': {
                active: '#FFC97A',
                bg: 'rgba(255, 201, 122, 0.13)'
            },
            'space-messages': {
                active: '#FFA899',
                bg: 'rgba(255, 168, 153, 0.13)'
            }
        };

        document.querySelectorAll('.tablinks').forEach((tab) => {
            tab.addEventListener('click', function () {
                const selected = theme[this.dataset.tab];
                if (!selected) return;

                document.documentElement.style.setProperty('--active-bg', selected.active);
                document.documentElement.style.setProperty('--active-bg-light', selected.bg);

                setTimeout(() => {
                    const firstConversation = getVisibleConversations(this.dataset.tab)[0];
                    if (firstConversation) {
                        renderChat(firstConversation.id);
                    } else {
                        refreshVisibleChat();
                    }
                }, 0);
            });
        });
    }

    function init() {
        updateSidebarMode();
        syncFilterButtons();
        renderChatLists();
        bindComposerInteractions();
        bindMenus();
        bindFilters();
        bindTabThemeColors();

        const initialConversation = getVisibleConversations('groomer-messages')[0];
        if (initialConversation) {
            renderChat(initialConversation.id);
        }
    }

    init();
}());
