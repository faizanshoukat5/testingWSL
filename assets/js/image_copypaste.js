function initializeAgreement(agreementId) {
    let selectedFiles = new Map();

    function getTimestamp() {
        const d = new Date();
        return [
            String(d.getHours()).padStart(2, '0'),
            String(d.getMinutes()).padStart(2, '0'),
            String(d.getSeconds()).padStart(2, '0'),
            '_',
            String(d.getMilliseconds()).padStart(3, '0')
        ].join('');
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.querySelector(`#fileInput${agreementId}`).files = dataTransfer.files;

        const hiddenFileInput = document.querySelector(`#uploadedFiles${agreementId}`);
        const hiddenDataTransfer = new DataTransfer();
        selectedFiles.forEach(file => hiddenDataTransfer.items.add(file));
        hiddenFileInput.files = hiddenDataTransfer.files;
    }

    function addFile(originalFile) {
        const timestamp = getTimestamp();
        const originalName = originalFile.name;
        const extension = originalName.split('.').pop();
        const baseName = originalName.substring(0, originalName.lastIndexOf('.'));

        // Rename only if the file name is exactly "image.png"
        let newFileName;
        if (originalName.toLowerCase() === "image.png") {
            newFileName = `${timestamp}_image.${extension}`;
        } else {
            newFileName = originalName;
        }

        const renamedFile = new File([originalFile], newFileName, {
            type: originalFile.type,
            lastModified: originalFile.lastModified
        });

        if (selectedFiles.has(newFileName)) {
            alert("Duplicate file: " + originalName);
            return false;
        }

        selectedFiles.set(newFileName, renamedFile);

        const preview = document.querySelector(`#preview${agreementId}`);
        const previewItem = document.createElement("div");
        previewItem.classList.add("preview-item");

        if (renamedFile.type.startsWith("image")) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                previewItem.appendChild(img);
            };
            reader.readAsDataURL(renamedFile);
        } else {
            const fileIcon = document.createElement("div");
            fileIcon.classList.add("file-icon");
            fileIcon.style.cssText = "background-color: #ddd; display: flex; justify-content: center; align-items: center; font-size: 40px; color: #666;";
            fileIcon.innerText = "📄";
            previewItem.appendChild(fileIcon);
        }

        const fileNameSpan = document.createElement("span");
        fileNameSpan.style.cssText = "font-size: 12px; word-break: break-all; margin-top: 5px;";
        // fileNameSpan.textContent = originalName;
        previewItem.appendChild(fileNameSpan);

        const removeBtn = document.createElement("button");
        removeBtn.innerText = "×";
        removeBtn.classList.add("remove-btn");
        removeBtn.onclick = function () {
            selectedFiles.delete(newFileName);
            previewItem.remove();
            updateFileInput();
        };

        previewItem.appendChild(removeBtn);
        preview.appendChild(previewItem);
        updateFileInput();
        return true;
    }

    document.querySelector(`#pasteInput${agreementId}`).addEventListener("paste", function(event) {
        const items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (let item of items) {
            if (item.kind === 'file') {
                const file = item.getAsFile();
                if (file) addFile(file);
            }
        }
    });

    document.querySelector(`#fileInput${agreementId}`).addEventListener("change", function(event) {
        for (let file of event.target.files) {
            if (!addFile(file)) {
                updateFileInput();
            }
        }
    });
}

// Initialize each agreement container
document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
    const agreementId = agreementContainer.getAttribute('data-agreement-id');
    const preview = agreementContainer.querySelector('.preview');
    preview.id = `preview${agreementId}`;
    const pasteInput = agreementContainer.querySelector('.pasteInput');
    pasteInput.id = `pasteInput${agreementId}`;
    const fileInput = agreementContainer.querySelector('.fileInput');
    fileInput.id = `fileInput${agreementId}`;
    const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
    hiddenFileInput.id = `uploadedFiles${agreementId}`;
    initializeAgreement(agreementId);
});








// function initializeAgreement(agreementId) {
//     let selectedFiles = new Map(); // Store unique files for each agreement

//     function updateFileInput() {
//         const dataTransfer = new DataTransfer();
//         selectedFiles.forEach(file => dataTransfer.items.add(file));
//         document.querySelector(`#fileInput${agreementId}`).files = dataTransfer.files;
//     }

//     function addFile(file) {
//         if (selectedFiles.has(file.name)) {
//             alert("Duplicate file: " + file.name);
//             return false; // Return false if file is a duplicate
//         }

//         selectedFiles.set(file.name, file);
//         const preview = document.querySelector(`#preview${agreementId}`);

//         const previewItem = document.createElement("div");
//         previewItem.classList.add("preview-item");

//         // Preview for images
//         if (file.type.startsWith("image")) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const img = document.createElement("img");
//                 img.src = e.target.result;
//                 previewItem.appendChild(img);
//             };
//             reader.readAsDataURL(file);
//         } else {
//             // Preview for non-image files, show a generic icon or text
//             const fileIcon = document.createElement("div");
//             fileIcon.classList.add("file-icon");
//             fileIcon.style.cssText = "width: 100%; height: 100%; background-color: #ddd; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666;";
//             fileIcon.innerText = "📄";
//             previewItem.appendChild(fileIcon);
//         }

//         const removeBtn = document.createElement("button");
//         removeBtn.innerText = "×";
//         removeBtn.classList.add("remove-btn");
//         removeBtn.onclick = function () {
//             selectedFiles.delete(file.name);
//             previewItem.remove();
//             updateFileInput(); // Update the file input after removing
//         };

//         previewItem.appendChild(removeBtn);
//         preview.appendChild(previewItem);
//         updateFileInput();
//         return true; // Return true if file is added successfully
//     }

//     // Handle paste events for image/file pasting
//     document.querySelector(`#pasteInput${agreementId}`).addEventListener("paste", function(event) {
//         const items = (event.clipboardData || event.originalEvent.clipboardData).items;

//         for (let item of items) {
//             if (item.kind === 'file') {
//                 const file = item.getAsFile();
//                 if (file) addFile(file);
//             }
//         }
//     });

//     // Handle file selection from the file input
//     document.querySelector(`#fileInput${agreementId}`).addEventListener("change", function(event) {
//         for (let file of event.target.files) {
//             if (!addFile(file)) {
//                 // If file is a duplicate, reset the file input to the current selected files
//                 updateFileInput();
//             }
//         }
//     });
// }

// // Initialize all agreements dynamically
// document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
//     const agreementId = agreementContainer.getAttribute('data-agreement-id');
//     const preview = agreementContainer.querySelector('.preview');
//     preview.id = `preview${agreementId}`;
//     const pasteInput = agreementContainer.querySelector('.pasteInput');
//     pasteInput.id = `pasteInput${agreementId}`;
//     const fileInput = agreementContainer.querySelector('.fileInput');
//     fileInput.id = `fileInput${agreementId}`;
//     initializeAgreement(agreementId);
// });





// const fileData = {
//     hashes: {},
//     names: {}
// };

// function attachPasteListener(inputElement, sectionId) {
//     initializeSection(sectionId);

//     inputElement.addEventListener("paste", (event) => {
//         const clipboardData = event.clipboardData || window.clipboardData;
//         const items = clipboardData.items;
//         let fileFound = false;
        
//         for (let i = 0; i < items.length; i++) {
//             if (items[i].type.indexOf("image") !== -1) {
//                 fileFound = true;
//                 const file = items[i].getAsFile();
//                 const fileHash = generateFileHash(file);
//                 if (file.name.toLowerCase() === "image.png") {
//                     return;
//                 }
//                 if (fileData.hashes[sectionId].has(fileHash)) return;
//                 const reader = new FileReader();
//                 reader.onload = (e) => {
//                     addImagePreview(inputElement, e.target.result, fileHash, file.name, sectionId);
//                 };
//                 reader.readAsDataURL(file);
//             }
//         }
//         if (!fileFound) {
//             const pastedText = clipboardData.getData("Text").trim();
//             inputElement.value = pastedText;
//             pasteImagePreview(inputElement);
//         }
//     });
// }

// function generateFileHash(file) {
//     return file.name + file.size;
// }

// function initializeSection(sectionId) {
//     if (!fileData.hashes[sectionId]) {
//         fileData.hashes[sectionId] = new Set();
//     }
//     if (!fileData.names[sectionId]) {
//         fileData.names[sectionId] = [];
//     }
// }

// function handleFileSelection(inputElement) {
//     const container = inputElement.closest(".form-group");
//     const sectionId = container.id;
//     initializeSection(sectionId);

//     const files = inputElement.files;
//     if (files) {
//         Array.from(files).forEach((file) => {
//             const fileHash = generateFileHash(file);
//             if (fileData.hashes[sectionId].has(fileHash)) return;
            
//             if (file.type.indexOf("image") !== -1) {
//                 const reader = new FileReader();
//                 reader.onload = (e) => {
//                     addImagePreview(inputElement, e.target.result, fileHash, file.name, sectionId);
//                 };
//                 reader.readAsDataURL(file);
//             } else {
//                 addFilePreview(inputElement, file, fileHash, file.name, sectionId);
//             }
//         });
//     }
// }

// function addImagePreview(inputElement, src, fileHash, fileName, sectionId) {
//     const imgPreviewContainer = inputElement.closest(".form-group").querySelector(".image-preview-container");
//     if (imgPreviewContainer.querySelector(`[data-file-hash="${fileHash}"]`)) return;

//     const previewWrapper = document.createElement("div");
//     previewWrapper.classList.add("image-preview-wrapper");
//     previewWrapper.style.cssText = "position:relative;width:60px;height:60px;display:inline-grid; margin: 5px 10px 0 1px;";

//     const imgPreview = document.createElement("img");
//     imgPreview.src = src;
//     imgPreview.classList.add("image-preview");
//     imgPreview.style.cssText = `width: 100%; height: 100%; border-radius: 10px; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2); overflow: hidden; margin: 1px 4px 0px 4px;`;

//     const cancelButton = document.createElement("span");
//     cancelButton.textContent = "x";
//     cancelButton.style.cssText = `position: absolute; top: 5px; right: -1px; cursor: pointer; color: white; font-size: 10px; background: red; border-radius: 50%; height: 13px; width: 13px; display: flex; align-items: center; justify-content: center; padding: 0;`;
//     cancelButton.setAttribute("data-toggle", "tooltip");
//     cancelButton.setAttribute("data-placement", "top");
//     cancelButton.setAttribute("title", "Delete");
    
//     cancelButton.onclick = () => {
//         previewWrapper.remove();
//         fileData.hashes[sectionId].delete(fileHash);
//         removeFileName(fileName, sectionId);
//         updateHiddenFileNames(sectionId);
//         const fileInput = inputElement.closest(".form-group").querySelector(".file-input");
//         clearFileInput(fileInput);
//     };
    
//     previewWrapper.setAttribute("data-file-hash", fileHash);
//     previewWrapper.append(imgPreview, cancelButton);
//     imgPreviewContainer.appendChild(previewWrapper);

//     fileData.hashes[sectionId].add(fileHash);
//     fileData.names[sectionId].push(fileName);
//     updateHiddenFileNames(sectionId);
// }

// function addFilePreview(inputElement, file, fileHash, fileName, sectionId) {
//     const imgPreviewContainer = inputElement.closest(".form-group").querySelector(".image-preview-container");
//     if (imgPreviewContainer.querySelector(`[data-file-hash="${fileHash}"]`)) return;

//     const previewWrapper = document.createElement("div");
//     previewWrapper.classList.add("image-preview-wrapper");
//     previewWrapper.style.cssText = "position:relative;width:60px;height:60px;display:-webkit-inline-box; margin: 5px 5px 0 5px;";

//     const fileIcon = document.createElement("div");
//     fileIcon.classList.add("file-icon");
//     fileIcon.style.cssText = "width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);";

//     const icon = document.createElement("span");
//     const fileExtension = file.name.split('.').pop().toLowerCase();
//     const fileIcons = {
//         default: "📄",
//     };

//     icon.textContent = fileIcons[fileExtension] || fileIcons.default;
//     fileIcon.appendChild(icon);

//     const cancelButton = document.createElement("span");
//     cancelButton.textContent = "x";
//     cancelButton.style.cssText = `position: absolute; top: 3px; right: 8px; cursor: pointer; color: white; font-size: 10px; background: red; border-radius: 50%; height: 13px; width: 13px; display: flex; align-items: center; justify-content: center; padding: 0;`;
//     cancelButton.setAttribute("data-toggle", "tooltip");
//     cancelButton.setAttribute("data-placement", "top");
//     cancelButton.setAttribute("title", "Delete");
    
//     cancelButton.onclick = () => {
//         previewWrapper.remove();
//         fileData.hashes[sectionId].delete(fileHash);
//         removeFileName(fileName, sectionId);
//         updateHiddenFileNames(sectionId);
//         const fileInput = inputElement.closest(".form-group").querySelector(".file-input");
//         clearFileInput(fileInput);
//     };

//     previewWrapper.setAttribute("data-file-hash", fileHash);
//     previewWrapper.append(fileIcon, cancelButton);
//     imgPreviewContainer.appendChild(previewWrapper);

//     fileData.hashes[sectionId].add(fileHash);
//     fileData.names[sectionId].push(fileName);
//     updateHiddenFileNames(sectionId);
// }

// function clearFileInput(input) {
//     try {
//         input.value = '';
//         if(input.value) {
//             input.type = 'text';
//             input.type = 'file';
//         }
//     } catch(e) {
//         const form = document.createElement('form');
//         const parentNode = input.parentNode;
//         const ref = input.nextSibling;
//         form.appendChild(input);
//         form.reset();
//         parentNode.insertBefore(input, ref);
//     }
// }

// function removeFileName(fileName, sectionId) {
//     const index = fileData.names[sectionId].indexOf(fileName);
//     if (index !== -1) {
//         fileData.names[sectionId].splice(index, 1);
//     }
// }

// function updateHiddenFileNames(sectionId) {
//     // Extract the section number from the sectionId (e.g., "fileUploadSection1" -> "1")
//     const sectionNumber = sectionId.replace(/\D/g, '');
//     const hiddenInput = document.getElementById(`uploadedFiles${sectionNumber}`);
//     if (hiddenInput) {
//         hiddenInput.value = fileData.names[sectionId].join(',');
//     }
// }

// function triggerFileInput(iconElement) {
//     const container = iconElement.closest(".form-group");
//     const fileInput = container.querySelector(".file-input");
//     fileInput.click();
// }

// window.onload = function () {
//     const urlInputs = document.querySelectorAll(".url-input");
//     urlInputs.forEach((inputElement) => {
//         const sectionId = inputElement.closest('.form-group').id;
//         attachPasteListener(inputElement, sectionId);
//     });

//     const fileInputs = document.querySelectorAll(".file-input");
//     fileInputs.forEach((inputElement) => {
//         inputElement.addEventListener("change", () => {
//             const sectionId = inputElement.closest('.form-group').id;
//             handleFileSelection(inputElement, sectionId);
//         });
//     });
// };
