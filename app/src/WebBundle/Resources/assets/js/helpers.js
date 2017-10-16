/* global document */
// Get element(s) by CSS selector:
function qs(selector, scope) {
  return (scope || document).querySelector(selector);
}

function qsa(selector, scope) {
  return (scope || document).querySelectorAll(selector);
}

// addEventListener wrapper:
function $on(target, type, callback, useCapture) {
  target.addEventListener(type, callback, !!useCapture);
}

// Attach a handler to event for all elements that match the selector,
// now or in the future, based on a root element
function $delegate(target, selector, type, handler) {
  function dispatchEvent(event) {
    const targetElement = event.target;
    const potentialElements = qsa(selector, target);
    const hasMatch = Array.prototype.indexOf.call(potentialElements, targetElement) >= 0;

    if (hasMatch) {
      handler.call(targetElement, event);
    }
  }

  // https://developer.mozilla.org/en-US/docs/Web/Events/blur
  const useCapture = type === 'blur' || type === 'focus';

  $on(target, type, dispatchEvent, useCapture);
}

// Find the element's parent with the given tag name:
// $parent(qs('a'), 'div');
function $parent(element, tagName) {
  if (!element.parentNode) {
    return element;
  }
  if (element.parentNode.tagName.toLowerCase() === tagName.toLowerCase()) {
    return element.parentNode;
  }
  return $parent(element.parentNode, tagName);
}

// removes an element from an array
// const x = [1,2,3]
// remove(x, 2)
// x ~== [1,3]
function remove(array, thing) {
  const index = array.indexOf(thing);
  if (index === -1) {
    return array;
  }
  array.splice(index, 1);
  return array;
}

export { qs, qsa, $on, $delegate, $parent, remove };

