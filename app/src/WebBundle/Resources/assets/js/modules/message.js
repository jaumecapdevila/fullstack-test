/* global document */
import { qs } from '../helpers';

function random() {
  const MIN_INDEX = 0;
  const availableMessages = [
    'Hi there buddy',
    'Whats up',
    'Hello',
  ];
  const MAX_INDEX = availableMessages.length - 1;
  const randomIndex = Math.floor(Math.random() * MAX_INDEX) + MIN_INDEX;
  return availableMessages[randomIndex];
}

function push(message, type) {
  const messagesList = qs('.messages-list');
  if (!messagesList) {
    return;
  }
  const messageItem = document.createElement('LI');
  messageItem.className = `message ${type}-message`;
  const messageTemplate = `
    <p class="message-text">${message}</p>
    <img class="message-img" src="/img/user_icon.png" alt="Profile image">
  `;
  messageItem.innerHTML = messageTemplate;
  messagesList.appendChild(messageItem);
}

function save(message) {
  const savePromise = new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/messages', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => resolve(xhr.status);
    xhr.onerror = () => reject(xhr.status);
    xhr.send(JSON.stringify({ message }));
  });
  return savePromise;
}

module.exports = { random, push, save };
